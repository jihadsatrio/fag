<?php namespace app\Algoritma;

use App\Models\Day;
use App\Models\Kapal;
use App\Models\Schedule;
use App\Models\Pembawakapal;
use App\Models\Time;
use App\Models\Timenotavailable;
use DB;

class GenerateAlgoritma
{
    public function randKromosom($kromosom, $count_pembawakapal, $input_year)
    {
        Schedule::truncate();

        for ($i = 0; $i < $kromosom; $i++)
        {
            $values = [];
            for ($j = 0; $j < $count_pembawakapal; $j++)
            {
                // $pembawakapal = pembawakapal::whereHas('course', function ($query) use ($input_semester)
                // {
                //     $query->where('courses.semester', $input_semester);
                // });

                $day   = Day::inRandomOrder()->first();
                $pembawakapal = Pembawakapal::where('year', $input_year)->inRandomOrder()->first();
                $kapal  = Kapal::where('type', $pembawakapal->agen->type)->inRandomOrder()->first();
                //return dd($room);
                $time  = Time::inRandomOrder()->first();

                $params = [
                    'pembawakapal_id' => $pembawakapal->id,
                    'days_id'   => $day->id,
                    'times_id'  => $time->id,
                    'kapal_id'  => $kapal->id,
                    'type'      => $i + 1,
                ];

                $schedule = Schedule::create($params);
            }
            $data[] = $values;
        }

        return $data;
    }

    public function checkPinalty()
    {
        $schedules = Schedule::select(DB::raw('pembawakapal_id, days_id, times_id, type, count(*) as `jumlah`'))
            ->groupBy('pembawakapal_id')
            ->groupBy('days_id')
            ->groupBy('times_id')
            ->groupBy('type')
            ->having('jumlah', '>', 1)
            ->get();

        $result_schedules = $this->increaseProccess($schedules);

        $schedules = Schedule::select(DB::raw('pembawakapal_id, days_id, kapal_id, type, count(*) as `jumlah`'))
            ->groupBy('pembawakapal_id')
            ->groupBy('days_id')
            ->groupBy('kapal_id')
            ->groupBy('type')
            ->having('jumlah', '>', 1)
            ->get();

        $result_schedules = $this->increaseProccess($schedules);

        $schedules = Schedule::select(DB::raw('times_id, days_id, kapal_id, type, count(*) as `jumlah`'))
            ->groupBy('times_id')
            ->groupBy('days_id')
            ->groupBy('kapal_id')
            ->groupBy('type')
            ->having('jumlah', '>', 1)
            ->get();

        $result_schedules = $this->increaseProccess($schedules);

        $schedules = Schedule::join('pembawakapal', 'pembawakapal.id', '=', 'schedules.pembawakapal_id')
            ->join('nahkoda', 'nahkoda.id', '=', 'pembawakapal.nahkoda_id')
            ->select(DB::raw('nahkoda_id, days_id, times_id, type, count(*) as `jumlah`'))
            ->groupBy('nahkoda_id')
            ->groupBy('days_id')
            ->groupBy('times_id')
            ->groupBy('type')
            ->having('jumlah', '>', 1)
            ->get();

        $result_schedules = $this->increaseProccess($schedules);

        $schedules = Schedule::where('days_id', Schedule::FRIDAY)->whereIn('times_id', [12, 19, 24])->get();

        if (!empty($schedules))
        {
            foreach ($schedules as $key => $schedule)
            {
                $schedule->value         = $schedule->value + 1;
                $schedule->value_process = $schedule->value_process . "+ 1 ";
                $schedule->save();
            }
        }

        $time_not_availables = Timenotavailable::get();

        if (!empty($time_not_availables))
        {
            foreach ($time_not_availables as $k => $time_not_available)
            {
                $schedules = Schedule::whereHas('pembawakapal', function ($query) use ($time_not_available)
                {
                    $query = $query->whereHas('nahkoda', function ($q) use ($time_not_available)
                    {
                        $q->where('nahkoda.id', $time_not_available->nahkoda_id);
                    });
                });

                $schedules = $schedules->where('days_id', $time_not_available->days_id)->where('times_id', $time_not_available->times_id)->get();

                if (!empty($schedules))
                {
                    foreach ($schedules as $key => $schedule)
                    {
                        $schedule->value         = $schedule->value + 1;
                        $schedule->value_process = $schedule->value_process . "+ 1 ";
                        $schedule->save();
                    }
                }

            }
        }

        $schedules = Schedule::get();

        foreach ($schedules as $key => $schedule)
        {
            $schedule->value = 1 / (1 + $schedule->value);
            $schedule->save();
        }

        return $schedules;
    }

    public function increaseProccess($schedules = '')
    {
        if (!empty($schedules))
        {
            foreach ($schedules as $key => $schedule)
            {
                if ($schedule->jumlah > 1)
                {
                    $schedule_wheres = Schedule::where('type', $schedule->type)->get();
                    foreach ($schedule_wheres as $key => $schedule_where)
                    {
                        $schedule_where->value         = $schedule_where->value + ($schedule->jumlah - 1);
                        $schedule_where->value_process = $schedule_where->value_process . " + " . ($schedule->jumlah - 1);
                        $schedule_where->save();
                    }
                }
            }
        }
        return $schedules;
    }

}
