<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Language;
use App\Models\caste;
use App\Models\Religion;
use App\Models\Lead;
use App\Models\Country;
use App\Models\state;
use App\Models\city;
use App\Models\register;
use App\Models\Mothertongue;
class ImportLead implements ToCollection
{
    public $email_old;
    public function collection(Collection $rows)
    {

        foreach ($rows as $key => $row1)
        {
            // To avoid title row
            if($key == 0){
                continue;
            }

                // if marital status is NEVER MAARIED no need to insert child
                if ($row1[7] != "Never Married"){
                    $no_of_children = $row1[8];
                } else {
                    $no_of_children = 1;
                }

                // Create religion title to table
                $religionId =Religion::where('religion_name', 'like', '%'.$row1[9].'%')->first();
                //dd($religionId);
                // if(!Religion::where('religion_name',$row1[9])->exists()){
                //     $religionId=Religion::create([
                //         'religion_name' =>$row1[9],
                //         'status' => 'APPROVED',
                //     ]);
                // }
                 // Create Caste title to table
                //  $casteId=null;
                //  if(!caste::where('religion_id',$religionId->religion_id)->exists())
                //  {
                //      $casteId=caste::create([
                //          'caste_name' => $row1[10],
                //          'religion_id' =>$religionId->religion_id,
                //          'status' => 'APPROVED',
                //      ]);
                //  }else{
                     
                  $casteId=caste::where('caste_name', 'like', '%'.$row1[10].'%')
                                     ->first();
                //  }

                 // For Languages
                 $langId=Mothertongue::where('mtongue_name',$row1[11])
                 ->first();

                 // For Country
                 $countryId=Country::where('country_name',$row1[12])
                 ->first();

                 // For state
                 $stateId=state::where('state_name',$row1[13])
                 ->first();

                 // For city
                 $cityId=city::where('city_name',$row1[14])
                 ->first();

                 // Insert in register table
                 if(!register::where('email',$row1[2])->exists())
                 {
                    $employee = register::create([
                        'firstname' => $row1[0],
                        'lastname' => $row1[1],
                        'email' => $row1[2],
                        'mobile_code' => $row1[3],
                        'mobile' =>$row1[4],
                        'gender' =>$row1[5],
                        'birthdate' =>$row1[6],
                        'm_status' =>$row1[7],
                        'tot_children' =>$row1[8],
                        'religion' =>$religionId->religion_id,
                        'caste' =>$casteId->caste_id,
                        'm_tongue' =>$langId->mtongue_id,
                        'country_id' =>$countryId->id,
                        'state_id' =>$stateId->state_id,
                        'city' =>$cityId->city_id,
                        'address' =>$row1[15],
                    ]);
                } else {
                    $this->email_old[] = $row1[2];
                    
                }

        }
        $email_old = $this->email_old;
        return $email_old;
    }

}


