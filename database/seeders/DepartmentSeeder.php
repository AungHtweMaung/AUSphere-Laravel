<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $deparments = [
            // faculties
            [
                'department_type_id' => 1,
                'title_short_term' => 'MSME',
                'title' => 'Martin de Tours School of Management and Economics',
                'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem cumque soluta unde. Quae dicta perspiciatis quaerat odit atque, ex possimus est. Illum, repellat tenetur. Fugit quas eveniet iure alias recusandae. Culpa porro omnis tenetur minus voluptatum rem harum, aperiam animi quae! Quae, commodi harum? Totam culpa unde dicta ducimus fuga, accusantium at. Qui, deserunt laudantium. Saepe rerum ducimus unde possimus! Cupiditate eaque iste itaque, at ipsum id aperiam dolorem exercitationem modi esse officiis nulla ipsam earum autem laborum odio numquam temporibus minima illum quod aut! Modi eum eos ea dolorem!'
            ],
            [
                'department_type_id' => 1,
                'title_short_term' => 'LAW',
                'title' => 'School of Law',
                'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem cumque soluta unde. Quae dicta perspiciatis quaerat odit atque, ex possimus est. Illum, repellat tenetur. Fugit quas eveniet iure alias recusandae. Culpa porro omnis tenetur minus voluptatum rem harum, aperiam animi quae! Quae, commodi harum? Totam culpa unde dicta ducimus fuga, accusantium at. Qui, deserunt laudantium. Saepe rerum ducimus unde possimus! Cupiditate eaque iste itaque, at ipsum id aperiam dolorem exercitationem modi esse officiis nulla ipsam earum autem laborum odio numquam temporibus minima illum quod aut! Modi eum eos ea dolorem!'
            ],
            [
                'department_type_id' => 1,
                'title_short_term' => 'BioTech',
                'title' => 'Biotechnology',
                'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem cumque soluta unde. Quae dicta perspiciatis quaerat odit atque, ex possimus est. Illum, repellat tenetur. Fugit quas eveniet iure alias recusandae. Culpa porro omnis tenetur minus voluptatum rem harum, aperiam animi quae! Quae, commodi harum? Totam culpa unde dicta ducimus fuga, accusantium at. Qui, deserunt laudantium. Saepe rerum ducimus unde possimus! Cupiditate eaque iste itaque, at ipsum id aperiam dolorem exercitationem modi esse officiis nulla ipsam earum autem laborum odio numquam temporibus minima illum quod aut! Modi eum eos ea dolorem!'
            ],

            // Communities
            [
                'department_type_id' => 2,
                'title_short_term' => 'AUSO',
                'title' => 'Assumption University Student Organization',
                'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem cumque soluta unde. Quae dicta perspiciatis quaerat odit atque, ex possimus est. Illum, repellat tenetur. Fugit quas eveniet iure alias recusandae. Culpa porro omnis tenetur minus voluptatum rem harum, aperiam animi quae! Quae, commodi harum? Totam culpa unde dicta ducimus fuga, accusantium at. Qui, deserunt laudantium. Saepe rerum ducimus unde possimus! Cupiditate eaque iste itaque, at ipsum id aperiam dolorem exercitationem modi esse officiis nulla ipsam earum autem laborum odio numquam temporibus minima illum quod aut! Modi eum eos ea dolorem!'
            ],
            [
                'department_type_id' => 2,
                'title_short_term' => 'AUISC',
                'title' => 'Assumption University International Students Community',
                'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem cumque soluta unde. Quae dicta perspiciatis quaerat odit atque, ex possimus est. Illum, repellat tenetur. Fugit quas eveniet iure alias recusandae. Culpa porro omnis tenetur minus voluptatum rem harum, aperiam animi quae! Quae, commodi harum? Totam culpa unde dicta ducimus fuga, accusantium at. Qui, deserunt laudantium. Saepe rerum ducimus unde possimus! Cupiditate eaque iste itaque, at ipsum id aperiam dolorem exercitationem modi esse officiis nulla ipsam earum autem laborum odio numquam temporibus minima illum quod aut! Modi eum eos ea dolorem!'
            ],
            [
                'department_type_id' => 2,
                'title_short_term' => 'AUMSC',
                'title' => 'Assumption University Music Society Club',
                'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem cumque soluta unde. Quae dicta perspiciatis quaerat odit atque, ex possimus est. Illum, repellat tenetur. Fugit quas eveniet iure alias recusandae. Culpa porro omnis tenetur minus voluptatum rem harum, aperiam animi quae! Quae, commodi harum? Totam culpa unde dicta ducimus fuga, accusantium at. Qui, deserunt laudantium. Saepe rerum ducimus unde possimus! Cupiditate eaque iste itaque, at ipsum id aperiam dolorem exercitationem modi esse officiis nulla ipsam earum autem laborum odio numquam temporibus minima illum quod aut! Modi eum eos ea dolorem!'
            ],

            // Club
            [
                'department_type_id' => 3,
                'title' => 'AP Club',
                'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem cumque soluta unde. Quae dicta perspiciatis quaerat odit atque, ex possimus est. Illum, repellat tenetur. Fugit quas eveniet iure alias recusandae. Culpa porro omnis tenetur minus voluptatum rem harum, aperiam animi quae! Quae, commodi harum? Totam culpa unde dicta ducimus fuga, accusantium at. Qui, deserunt laudantium. Saepe rerum ducimus unde possimus! Cupiditate eaque iste itaque, at ipsum id aperiam dolorem exercitationem modi esse officiis nulla ipsam earum autem laborum odio numquam temporibus minima illum quod aut! Modi eum eos ea dolorem!'
            ],
            [
                'department_type_id' => 3,
                'title' => 'Music Club',
                'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem cumque soluta unde. Quae dicta perspiciatis quaerat odit atque, ex possimus est. Illum, repellat tenetur. Fugit quas eveniet iure alias recusandae. Culpa porro omnis tenetur minus voluptatum rem harum, aperiam animi quae! Quae, commodi harum? Totam culpa unde dicta ducimus fuga, accusantium at. Qui, deserunt laudantium. Saepe rerum ducimus unde possimus! Cupiditate eaque iste itaque, at ipsum id aperiam dolorem exercitationem modi esse officiis nulla ipsam earum autem laborum odio numquam temporibus minima illum quod aut! Modi eum eos ea dolorem!'
            ],
            [
                'department_type_id' => 3,
                'title' => 'Football Club',
                'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem cumque soluta unde. Quae dicta perspiciatis quaerat odit atque, ex possimus est. Illum, repellat tenetur. Fugit quas eveniet iure alias recusandae. Culpa porro omnis tenetur minus voluptatum rem harum, aperiam animi quae! Quae, commodi harum? Totam culpa unde dicta ducimus fuga, accusantium at. Qui, deserunt laudantium. Saepe rerum ducimus unde possimus! Cupiditate eaque iste itaque, at ipsum id aperiam dolorem exercitationem modi esse officiis nulla ipsam earum autem laborum odio numquam temporibus minima illum quod aut! Modi eum eos ea dolorem!'
            ],
        ];

        foreach($deparments as $department)
        {
            Department::create($department);
        }
    }
}
