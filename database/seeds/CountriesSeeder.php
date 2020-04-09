<?php

use Illuminate\Database\Seeder;

class CountriesSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return  void
     */
    public function run()
    {
        //Empty the countries table
        DB::table(\Config::get('countries.table_name'))->delete();

        //Get all of the countries
        $countries = Countries::getList();
        foreach ($countries as $countryId => $country){
            DB::table(\Config::get('countries.table_name'))->insert(array(
                'iso_3166_2' => $country['iso_3166_2'],
                'name' => $country['name'],
            ));
        }
    }
}
