<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Carbon\Carbon;

class KpiSeeder extends Seeder
{
    public function run(): void
    {
        $filePath = database_path('seeders/Vintazk Sitewide KPI 2025.xlsx');
        $spreadsheet = IOFactory::load($filePath);

        foreach ($spreadsheet->getSheetNames() as $sheetName) {
            $sheet = $spreadsheet->getSheetByName($sheetName);
            $rows = $sheet->toArray(null, true, true, true);

            // convert sheet name like "January 2025" -> "2025-01-01"
            $period = Carbon::parse("first day of $sheetName")->format('Y-m-d');

            foreach ($rows as $index => $row) {
                // skip header or empty rows
                if ($index === 1 || empty($row['A'])) {
                    continue;
                }

                /**
                 * 🔹 Agent Data
                 * We detect agent rows by "Agent Name" in col A and "Team" in col B
                 */
                if (!empty($row['A']) && !empty($row['B']) && !empty($row['C'])) {
                    DB::table('agents')->insert([
                        'agent_name' => $row['A'],
                        'team' => $row['B'],
                        'productivity' => $this->normalize($row['C']),
                        'timeliness' => $this->normalize($row['D']),
                        'qa' => $this->normalize($row['E']),
                        'attendance' => $this->normalize($row['F']),
                        'kpi_performance' => $this->normalize($row['G']),
                        'behavioral' => $this->normalize($row['H']),
                        'behavior' => $this->normalize($row['I']),
                        'ivp' => $this->normalize($row['J']),
                        'overall_performance_rating' => $this->normalize($row['K']),
                        'quiz' => $this->normalize($row['L']),
                        'period' => $period,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                /**
                 * 🔹 Team Data
                 * We detect team rows by values in col N (Name) and col O (Team)
                 */
                if (!empty($row['N']) && !empty($row['O'])) {
                    DB::table('teams')->insert([
                        'name' => $row['N'], // Team lead
                        'team' => $row['O'], // Team name
                        'attendance' => $this->normalize($row['P']),
                        'team_kpi' => $this->normalize($row['Q']),
                        'attrition' => $this->normalize($row['R']),
                        'ivp' => $this->normalize($row['S']),
                        'performance_rating' => $this->normalize($row['T']),
                        'period' => $period,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }

    private function normalize($value)
    {
        if ($value === null || $value === '' || $value === 'N/A') {
            return null;
        }

        // Convert percentages like 90% -> 90.00
        if (is_string($value) && str_contains($value, '%')) {
            return floatval(str_replace('%', '', $value));
        }

        return is_numeric($value) ? floatval($value) : null;
    }
}
