<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\SimpleExcel\SimpleExcelReader;
use App\Models\Item;

class ImportCSVJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $pathToCsv = storage_path('app/public/meyer_inventory.csv');
        $rows = SimpleExcelReader::create($pathToCsv)
        ->useHeaders(['MFGName','MFG Item Number','Item Number','Available','LTL','MFG Qty Available','Stocking','Special Order','Oversize','Addtl Handling Charge'])
        ->getRows()
        ->each(function($row) {
            $data = $this->convertItem($row);
            Item::query()->create($data);
        });    
    }

    public function convertItem(array $data): array {
        $itemData = [
            'mfg_name' => $data['MFGName'],
            'mfg_item_number' => $data['MFG Item Number'],
            'item_number' => $data['Item Number'],
            'available' => (int) $data['Available'],
            'ltl' => strtolower($data['LTL']) === 'true',
            'mfg_qty_available' => $data['MFG Qty Available'] === '' ? null : (int) $data['MFG Qty Available'],
            'stocking' => $data['Stocking'],
            'special_order' => $data['Special Order'],
            'oversize' => $data['Oversize'],
            'addtl_handling_charge' => $data['Addtl Handling Charge'],
        ];
    
        return $itemData;
    }
    
}
