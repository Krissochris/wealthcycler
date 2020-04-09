<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class StatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('states')->delete();

        $data = [
            [
                'id' => '1',
                'state' => 'Abia State',
            ],
            [
                'id' => '2',
                'state' => 'Adamawa State',
            ],
            [
                'id' => '3',
                'state' => 'Akwa Ibom State',
            ],
            [
                'id' => '4',
                'state' => 'Anambra State',
            ],
            [
                'id' => '5',
                'state' => 'Bauchi State',
            ],
            [
                'id' => '6',
                'state' => 'Bayelsa State',
            ],
            [
                'id' => '7',
                'state' => 'Benue State',
            ],
            [
                'id' => '8',
                'state' => 'Borno State',
            ],
            [
                'id' => '9',
                'state' => 'Cross River State',
            ],
            [
                'id' => '10',
                'state' => 'Delta State',
            ],
            [
                'id' => '11',
                'state' => 'Ebonyi State',
            ],
            [
                'id' => '12',
                'state' => 'Edo State',
            ],
            [
                'id' => '13',
                'state' => 'Ekiti State',
            ],
            [
                'id' => '14',
                'state' => 'Enugu State',
            ],
            [
                'id' => '15',
                'state' => 'FCT',
            ],
            [
                'id' => '16',
                'state' => 'Gombe State',
            ],
            [
                'id' => '17',
                'state' => 'Imo State',
            ],
            [
                'id' => '18',
                'state' => 'Jigawa State',
            ],
            [
                'id' => '19',
                'state' => 'Kaduna State',
            ],
            [
                'id' => '20',
                'state' => 'Kano State',
            ],
            [
                'id' => '21',
                'state' => 'Katsina State',
            ],
            [
                'id' => '22',
                'state' => 'Kebbi State',
            ],
            [
                'id' => '23',
                'state' => 'Kogi State',
            ],
            [
                'id' => '24',
                'state' => 'Kwara State',
            ],
            [
                'id' => '25',
                'state' => 'Lagos State',
            ],
            [
                'id' => '26',
                'state' => 'Nasarawa State',
            ],
            [
                'id' => '27',
                'state' => 'Niger State',
            ],
            [
                'id' => '28',
                'state' => 'Ogun State',
            ],
            [
                'id' => '29',
                'state' => 'Ondo State',
            ],
            [
                'id' => '30',
                'state' => 'Osun State',
            ],
            [
                'id' => '31',
                'state' => 'Oyo State',
            ],
            [
                'id' => '32',
                'state' => 'Plateau State',
            ],
            [
                'id' => '33',
                'state' => 'Rivers State',
            ],
            [
                'id' => '34',
                'state' => 'Sokoto State',
            ],
            [
                'id' => '35',
                'state' => 'Taraba State',
            ],
            [
                'id' => '36',
                'state' => 'Yobe State',
            ],
            [
                'id' => '37',
                'state' => 'Zamfara State',
            ],
        ];
        $nigeria_id = DB::table('countries')
            ->where('iso_3166_2', 'NG')
            ->pluck('id')
            ->first();

        foreach($data as $state)
        DB::table('states')->insert(array('id' => $state['id'],
            'name' => $state['state'],
            'country_code' => 'NG',
            'country_id' => $nigeria_id));
    }
}
