<?php

namespace App;
use App\Models\Settings;
use Illuminate\Support\Facades\Log;

class YearlyIdSequenceService
{
    public function resetIdSequence()
    {
        try {
            // Get the current year
            $currentYear = now()->year;

            // Fetch the setting with shortCode 'IDG'
            $setting = Settings::where('shortCode', 'IDG')->first();

            if ($setting) {
                // Check if the last updated year is different from the current year
                $lastUpdatedYear = $setting->updated_at ? $setting->updated_at->year : null;

                if ($lastUpdatedYear !== $currentYear) {
                    // Reset the value to 00001
                    $setting->value = '00001';
                    $setting->save();

                    Log::info("ID sequence reset for shortCode 'IDG' for the year {$currentYear}.");
                }
            }
        } catch (\Exception $e) {
            Log::error('Error while resetting ID sequence: ' . $e->getMessage(), [
                'exception' => $e,
            ]);
        }
    }
}
