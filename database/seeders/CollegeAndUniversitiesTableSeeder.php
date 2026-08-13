<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CollegeAndUniversitiesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('college_and_universities')->delete();
        
        \DB::table('college_and_universities')->insert(array (
            0 => 
            array (
                'id' => 12,
                'country_id' => 4,
                'image' => '1760441139_1537432048phphoR0m5.jpeg',
                'image_alt' => 'University of Sunderland campus image',
                'name' => 'University of Sunderland',
                'description' => 'Located at Chester Road, Sunderland, SR1 3SD',
                'link' => 'https://london.sunderland.ac.uk/',
                'created_at' => '2025-10-14 16:17:07',
                'updated_at' => '2025-10-16 13:14:39',
            ),
            1 => 
            array (
                'id' => 13,
                'country_id' => 4,
                'image' => '1760503098_Ravensbourne university.jpg',
                'image_alt' => 'University of Ravensbourne campus image',
                'name' => 'University of Ravensbourne',
                'description' => 'Located at 6 Penrose Way, Greenwich Peninsula, SE10 0EW',
                'link' => 'https://www.oxfordinternational.com/universities/ravensbourne-university-london/',
                'created_at' => '2025-10-14 16:21:29',
                'updated_at' => '2025-10-16 13:16:14',
            ),
            2 => 
            array (
                'id' => 14,
                'country_id' => 4,
                'image' => '1760441532_1551077621phpCnh03D.jpeg',
                'image_alt' => 'University of Roehampton campus image',
                'name' => 'University of Roehampton',
                'description' => 'Located at Roehampton Ln, London SW15 5PH',
                'link' => 'https://www.oxfordinternational.com/universities/university-of-roehampton-london/',
                'created_at' => '2025-10-14 16:23:09',
                'updated_at' => '2025-10-16 13:17:38',
            ),
            3 => 
            array (
                'id' => 15,
                'country_id' => 4,
                'image' => '1760441622_1411040730phpL3WRkg.jpeg',
                'image_alt' => 'BPP University campus image',
                'name' => 'BPP University',
                'description' => 'Located at BPP House, 142–144 Uxbridge Road, London W12 8AA',
                'link' => 'https://www.oxfordinternational.com/universities/bpp/',
                'created_at' => '2025-10-14 16:24:13',
                'updated_at' => '2025-10-16 13:19:04',
            ),
            4 => 
            array (
                'id' => 16,
                'country_id' => 4,
                'image' => '1760442097_uwl_49225925804.jpg',
                'image_alt' => 'University of West London campus image',
                'name' => 'University of West London',
                'description' => 'Located at St Mary&#039;s Road, Ealing, London W5 5RF',
                'link' => 'https://www.uwl.ac.uk/',
                'created_at' => '2025-10-14 16:25:43',
                'updated_at' => '2025-10-16 13:20:36',
            ),
            5 => 
            array (
                'id' => 17,
                'country_id' => 4,
                'image' => '1760442243_Pathways-Feature-Image-London-UEL-Homepage-10-1024x682.jpg',
                'image_alt' => 'University of East London campus image',
                'name' => 'University of East London',
                'description' => 'Located at University Way, London E16 2RD',
                'link' => 'https://www.uel.ac.uk/',
                'created_at' => '2025-10-14 16:27:05',
                'updated_at' => '2025-10-16 13:21:02',
            ),
            6 => 
            array (
                'id' => 18,
                'country_id' => 4,
                'image' => '1760502411_campus-william-morris-767x460.jpg',
                'image_alt' => 'Coventry University campus image',
                'name' => 'Coventry University',
                'description' => 'Located at Priory Street, Coventry CV1 5FB',
                'link' => 'https://www.coventry.ac.uk/',
                'created_at' => '2025-10-14 16:28:10',
                'updated_at' => '2025-10-16 13:07:00',
            ),
            7 => 
            array (
                'id' => 19,
                'country_id' => 4,
                'image' => '1760503417_University College Birmingham.jpg',
                'image_alt' => 'University College Birmingham campus image',
                'name' => 'University College Birmingham',
                'description' => 'Located at Summer Row, Birmingham B3 1JB',
                'link' => 'https://www.ucb.ac.uk/',
                'created_at' => '2025-10-14 16:30:05',
                'updated_at' => '2025-10-16 13:21:28',
            ),
            8 => 
            array (
                'id' => 20,
                'country_id' => 4,
                'image' => '1760502782_elevation-from-northeast-c-bitterbredt-2280x1485.jpg',
                'image_alt' => 'London Metropolitan University campus image',
                'name' => 'London Metropolitan University',
                'description' => 'Located at 166-220 Holloway Rd, London N7 8DB',
                'link' => 'https://www.londonmet.ac.uk/',
                'created_at' => '2025-10-14 16:31:14',
                'updated_at' => '2025-10-16 13:21:40',
            ),
            9 => 
            array (
                'id' => 21,
                'country_id' => 4,
                'image' => '1760502880_imgonline-com-ua-resize-39jOGTB4f67gK4_1138013490.jpg',
                'image_alt' => 'University of Wolverhampton campus image',
                'name' => 'University of Wolverhampton',
                'description' => 'Located at Wulfruna Street, Wolverhampton, West Midlands WV1 1LY',
                'link' => 'https://www.wlv.ac.uk/',
                'created_at' => '2025-10-14 16:32:24',
                'updated_at' => '2025-10-16 13:21:52',
            ),
            10 => 
            array (
                'id' => 22,
                'country_id' => 4,
                'image' => '1760504182_west of scotland.jpeg',
                'image_alt' => 'University of the West of Scotland campus image',
                'name' => 'University of the West of Scotland',
                'description' => 'Located at Hamilton International Technology Park, Stephenson Pl, Blantyre, Glasgow G72 0LH',
                'link' => 'https://www.uws.ac.uk/university-life/campuses/london-campus/',
                'created_at' => '2025-10-14 16:36:51',
                'updated_at' => '2025-10-16 13:22:44',
            ),
            11 => 
            array (
                'id' => 23,
                'country_id' => 4,
                'image' => '1760504194_Health science university.jpg',
                'image_alt' => 'Health Sciences University campus image',
                'name' => 'Health Sciences University',
                'description' => 'Located at Parkwood Campus, 13-15 Parkwood Rd, Bournemouth BH5 2DF',
                'link' => 'https://www.hsu.ac.uk/',
                'created_at' => '2025-10-14 16:38:00',
                'updated_at' => '2025-10-16 13:23:32',
            ),
            12 => 
            array (
                'id' => 24,
                'country_id' => 4,
                'image' => '1760504211_hertfordshire.jpg',
                'image_alt' => 'University of Hertfordshire campus image',
                'name' => 'University of Hertfordshire',
                'description' => 'Located at College Lane, Hatfield, Hertfordshire AL10 9AB',
                'link' => 'https://www.herts.ac.uk/',
                'created_at' => '2025-10-14 16:44:20',
                'updated_at' => '2025-10-16 13:24:40',
            ),
            13 => 
            array (
                'id' => 25,
                'country_id' => 4,
                'image' => '1760504223_York st john.jpg',
                'image_alt' => 'York St John University campus image',
                'name' => 'York St John University',
                'description' => 'Located at Lord Mayor\'s Walk, York YO31 7EX',
                'link' => 'https://www.yorksj.ac.uk/',
                'created_at' => '2025-10-14 16:48:43',
                'updated_at' => '2025-10-16 13:25:33',
            ),
            14 => 
            array (
                'id' => 26,
                'country_id' => 4,
                'image' => '1760504481_cardiff.jpg',
                'image_alt' => 'Cardiff University campus image',
                'name' => 'Cardiff University',
                'description' => 'Located at Park Place, Cathays Park, Cardiff CF10 3AT',
                'link' => 'https://www.cardiff.ac.uk/',
                'created_at' => '2025-10-14 16:49:36',
                'updated_at' => '2025-10-16 13:27:19',
            ),
            15 => 
            array (
                'id' => 27,
                'country_id' => 4,
                'image' => '1760504286_Huddersfield.jpg',
                'image_alt' => 'University of Huddersfield campus image',
                'name' => 'University of Huddersfield',
                'description' => 'Located at Queensgate, Huddersfield HD1 3DH',
                'link' => 'https://www.hud.ac.uk/',
                'created_at' => '2025-10-14 16:50:46',
                'updated_at' => '2025-10-16 13:28:37',
            ),
            16 => 
            array (
                'id' => 28,
                'country_id' => 2,
                'image' => '1760514488_download.jpg',
                'image_alt' => 'Charles Darwin University campus image',
                'name' => 'Charles Darwin University',
                'description' => 'Located at Ellengowan Drive, Casuarina, Northern Territory 0810',
                'link' => 'https://www.cdu.edu.au/',
                'created_at' => '2025-10-15 12:20:51',
                'updated_at' => '2025-10-16 13:54:38',
            ),
            17 => 
            array (
                'id' => 29,
                'country_id' => 2,
                'image' => '1760518578_images.jpg',
                'image_alt' => 'Central Queensland University campus image',
                'name' => 'Central Queensland University',
                'description' => 'Located at Bruce Highway, North Rockhampton, Queensland 4701',
                'link' => 'https://www.cqu.edu.au/',
                'created_at' => '2025-10-15 12:23:32',
                'updated_at' => '2025-10-16 13:54:24',
            ),
            18 => 
            array (
                'id' => 30,
                'country_id' => 2,
                'image' => '1760518647_JCU2_web-1333x1000.jpg',
                'image_alt' => 'James Cook University campus image',
                'name' => 'James Cook University',
                'description' => 'Located at 1 James Cook Drive, Douglas, Queensland 4814',
                'link' => 'https://www.jcu.edu.au/',
                'created_at' => '2025-10-15 12:24:41',
                'updated_at' => '2025-10-16 13:55:59',
            ),
            19 => 
            array (
                'id' => 31,
                'country_id' => 2,
                'image' => '1760518709_Griffith-2020_Web-1-1333x1000.jpg',
                'image_alt' => 'Griffith University campus image',
                'name' => 'Griffith University',
                'description' => 'Located at 170 Kessels Road, Nathan, Queensland 4111',
                'link' => 'https://www.griffith.edu.au/',
                'created_at' => '2025-10-15 12:26:17',
                'updated_at' => '2025-10-16 13:57:09',
            ),
            20 => 
            array (
                'id' => 32,
                'country_id' => 2,
                'image' => '1760518905_istockphoto-1142794887-612x612.jpg',
                'image_alt' => 'University of Notre Dame campus image',
                'name' => 'University of Notre Dame',
                'description' => 'Located at 32 Mouat Street, Fremantle WA 6160',
                'link' => 'https://www.notredame.edu.au/',
                'created_at' => '2025-10-15 12:27:43',
                'updated_at' => '2025-10-16 14:48:14',
            ),
            21 => 
            array (
                'id' => 34,
                'country_id' => 2,
                'image' => '1760518980_istockphoto-1321855488-612x612.jpg',
                'image_alt' => 'Macquarie University campus image',
                'name' => 'Macquarie University',
                'description' => 'Located at  Balaclava Rd, Macquarie Park NSW 2113',
                'link' => 'https://www.mq.edu.au/',
                'created_at' => '2025-10-15 12:32:22',
                'updated_at' => '2025-10-16 14:49:21',
            ),
            22 => 
            array (
                'id' => 35,
                'country_id' => 2,
                'image' => '1760519081_images.jpg',
                'image_alt' => 'The University of Sydney campus image',
                'name' => 'The University of Sydney',
                'description' => 'Located at Camperdown, Sydney, NSW 2050',
                'link' => 'https://www.sydney.edu.au/',
                'created_at' => '2025-10-15 12:34:26',
                'updated_at' => '2025-10-16 15:05:34',
            ),
            23 => 
            array (
                'id' => 36,
                'country_id' => 2,
                'image' => '1760519149_University-of-Wollongong-India-campus-1.jpg',
                'image_alt' => 'University of Wollongong campus image',
                'name' => 'University of Wollongong',
                'description' => 'Located at Northfields Ave, Wollongong NSW 2500',
                'link' => 'https://www.uow.edu.au/',
                'created_at' => '2025-10-15 12:35:53',
                'updated_at' => '2025-10-16 14:53:55',
            ),
            24 => 
            array (
                'id' => 37,
                'country_id' => 2,
                'image' => '1760519217_l2-campuses-sunshine-960x540px.jpg',
                'image_alt' => 'Western Sydney University campus image',
                'name' => 'Western Sydney University',
                'description' => 'Located at Lot 21, James Ruse Drive, Parramatta, Sydney, NSW 2150',
                'link' => 'https://www.westernsydney.edu.au/',
                'created_at' => '2025-10-15 12:36:53',
                'updated_at' => '2025-10-16 15:03:41',
            ),
            25 => 
            array (
                'id' => 38,
                'country_id' => 2,
                'image' => '1760519354_hires_46IdUwqRqzYmI9GX_sized.jpg',
                'image_alt' => 'University of Canberra campus image',
                'name' => 'University of Canberra',
                'description' => 'Located at 11 Kirinari Street, Bruce, Canberra, ACT 2617',
                'link' => 'https://www.canberra.edu.au/',
                'created_at' => '2025-10-15 12:38:26',
                'updated_at' => '2025-10-16 15:03:02',
            ),
            26 => 
            array (
                'id' => 39,
                'country_id' => 2,
                'image' => '1760511412_ltu_about_image1.jpg',
                'image_alt' => 'La Trobe University campus image',
                'name' => 'La Trobe University',
                'description' => 'Located at Kingsbury Dr & Plenty Rd, Bundoora, Melbourne, VIC 3086',
                'link' => 'https://www.latrobe.edu.au/',
                'created_at' => '2025-10-15 12:41:52',
                'updated_at' => '2025-10-16 15:01:57',
            ),
            27 => 
            array (
                'id' => 40,
                'country_id' => 2,
                'image' => '1760511571_vu-city-tower-landscape.jpg',
                'image_alt' => 'Victoria University campus image',
                'name' => 'Victoria University',
                'description' => 'Located at Ballarat Road, Footscray VIC 3011, Melbourne',
                'link' => 'https://www.vu.edu.au/',
                'created_at' => '2025-10-15 12:44:31',
                'updated_at' => '2025-10-16 15:01:17',
            ),
            28 => 
            array (
                'id' => 41,
                'country_id' => 2,
                'image' => '1760511687_1585549140php6U7GU0.jpeg',
                'image_alt' => 'Torrens University campus image',
                'name' => 'Torrens University',
                'description' => 'Located at 196 Flinders Street, Melbourne, VIC 3000',
                'link' => 'https://www.torrens.edu.au/',
                'created_at' => '2025-10-15 12:46:27',
                'updated_at' => '2025-10-16 15:08:21',
            ),
            29 => 
            array (
                'id' => 42,
                'country_id' => 2,
                'image' => '1760512044_edith-new.jpg',
                'image_alt' => 'Edith Cowan University campus image',
                'name' => 'Edith Cowan University',
                'description' => 'Located at 270 Joondalup Drive, Joondalup, Perth, WA 6027',
                'link' => 'https://www.ecu.edu/',
                'created_at' => '2025-10-15 12:51:25',
                'updated_at' => '2025-10-16 15:11:57',
            ),
            30 => 
            array (
                'id' => 43,
                'country_id' => 2,
                'image' => '1760512399_clz.jpg',
                'image_alt' => 'Sydney Metropolitan International College campus image',
                'name' => 'Sydney Metropolitan International College',
                'description' => 'Located at 432-434 Kent St, Sydney NSW 2000',
                'link' => 'https://smic.edu.au/',
                'created_at' => '2025-10-15 12:58:19',
                'updated_at' => '2025-10-16 15:19:56',
            ),
            31 => 
            array (
                'id' => 44,
                'country_id' => 2,
                'image' => '1760512569_images.jpg',
                'image_alt' => 'Wentworth Institute of Higher Education campus image',
                'name' => 'Wentworth Institute of Higher Education',
                'description' => 'Located at Level 1–5, 302–306 Elizabeth Street, Surry Hills, Sydney, NSW 2010',
                'link' => 'https://www.win.edu.au/',
                'created_at' => '2025-10-15 13:01:09',
                'updated_at' => '2025-10-16 15:24:38',
            ),
            32 => 
            array (
                'id' => 45,
                'country_id' => 2,
                'image' => '1760512816_1-300x143.jpeg',
                'image_alt' => 'Onepath College campus image',
                'name' => 'Onepath College',
                'description' => 'Located at Suite 101, Level 1, 30 Cowper Street, Parramatta, Sydney, NSW 2150',
                'link' => 'https://www.onepath.edu.au/',
                'created_at' => '2025-10-15 13:05:16',
                'updated_at' => '2025-10-16 15:26:05',
            ),
            33 => 
            array (
                'id' => 46,
                'country_id' => 2,
            'image' => '1760512944_images (1).jpg',
                'image_alt' => 'National Academy of Professional Studies campus image',
                'name' => 'National Academy of Professional Studies',
                'description' => 'Located at Level 4, 136 Chalmers Street, Surry Hills, Sydney, NSW 2010',
                'link' => 'https://www.onepath.edu.au/',
                'created_at' => '2025-10-15 13:07:24',
                'updated_at' => '2025-10-16 15:28:12',
            ),
            34 => 
            array (
                'id' => 47,
                'country_id' => 2,
            'image' => '1760513135_images (2).jpg',
                'image_alt' => 'ASA Institute of Higher Education campus image',
                'name' => 'ASA Institute of Higher Education',
                'description' => 'Located at Level 9/140 Elizabeth St, Sydney NSW 2000',
                'link' => 'https://asahe.edu.au/',
                'created_at' => '2025-10-15 13:10:35',
                'updated_at' => '2025-10-16 15:30:09',
            ),
            35 => 
            array (
                'id' => 48,
                'country_id' => 2,
            'image' => '1760513298_images (3).jpg',
                'image_alt' => 'Sydney City College of Management campus image',
                'name' => 'Sydney City College of Management',
                'description' => 'Located at Level 2, 17 Macquarie Street, Parramatta, NSW 2150',
                'link' => 'https://sccm.edu.au/',
                'created_at' => '2025-10-15 13:13:18',
                'updated_at' => '2025-10-16 15:32:35',
            ),
            36 => 
            array (
                'id' => 49,
                'country_id' => 3,
                'image' => '1760521559_UCW-Vancouver-House-Campus-3-1024x533.jpg',
                'image_alt' => 'University Canada West campus image',
                'name' => 'University Canada West',
                'description' => 'Located at 1461 Granville Street, Vancouver, BC V6Z 0E5',
                'link' => 'https://www.ucanwest.ca/',
                'created_at' => '2025-10-15 14:49:47',
                'updated_at' => '2025-10-16 13:45:39',
            ),
            37 => 
            array (
                'id' => 50,
                'country_id' => 3,
                'image' => '1760521437_images.jpeg',
                'image_alt' => 'University of Toronto campus image',
                'name' => 'University of Toronto',
                'description' => 'Located at 27 King\'s College Cir, Toronto, ON M5S 1A1',
                'link' => 'https://www.utoronto.ca/',
                'created_at' => '2025-10-15 14:51:02',
                'updated_at' => '2025-10-16 13:46:32',
            ),
            38 => 
            array (
                'id' => 51,
                'country_id' => 3,
                'image' => '1760521369_1537264772php506TJF.jpeg',
                'image_alt' => 'Laurentian University campus image',
                'name' => 'Laurentian University',
                'description' => 'Located at 935 Ramsey Lake Rd, Sudbury, ON P3E 2C6',
                'link' => 'https://laurentian.ca/',
                'created_at' => '2025-10-15 14:54:09',
                'updated_at' => '2025-10-16 13:47:25',
            ),
            39 => 
            array (
                'id' => 52,
                'country_id' => 3,
                'image' => '1760521306_6.3.2_Brampton_SSM_Campus_460x330-1.jpg',
                'image_alt' => 'Algoma University campus image',
                'name' => 'Algoma University',
                'description' => 'Located at 1520 Queen Street East, Sault Ste. Marie, Ontario P6A 2G4',
                'link' => 'https://algomau.ca/',
                'created_at' => '2025-10-15 14:56:53',
                'updated_at' => '2025-10-16 13:49:16',
            ),
            40 => 
            array (
                'id' => 53,
                'country_id' => 3,
                'image' => '1760521203_Interior_Exterior00NS8CCC.jpeg',
                'image_alt' => 'Yorkville University campus image',
                'name' => 'Yorkville University',
                'description' => 'Located at 460 Yonge Street, Toronto, Ontario',
                'link' => 'https://www.yorkvilleu.ca/',
                'created_at' => '2025-10-15 14:58:00',
                'updated_at' => '2025-10-16 13:35:59',
            ),
            41 => 
            array (
                'id' => 54,
                'country_id' => 3,
                'image' => '1760521064_academic-green-aerial-1600x900.jpg',
                'image_alt' => 'University of Regina campus image',
                'name' => 'University of Regina',
                'description' => 'Located at 3737 Wascana Parkway, Regina, Saskatchewan S4S 0A2',
                'link' => 'https://www.uregina.ca/',
                'created_at' => '2025-10-15 14:58:56',
                'updated_at' => '2025-10-16 13:36:53',
            ),
            42 => 
            array (
                'id' => 55,
                'country_id' => 3,
                'image' => '1760520988_barrie-campus-georgian-college-of-applied-arts-and-technology-georgian-college-fall-2014.jpg',
                'image_alt' => 'Georgian College campus image',
                'name' => 'Georgian College',
                'description' => 'Located at One Georgian Dr., Barrie, ON L4M 3X9',
                'link' => 'https://www.georgiancollege.ca/',
                'created_at' => '2025-10-15 15:01:31',
                'updated_at' => '2025-10-16 13:37:55',
            ),
            43 => 
            array (
                'id' => 56,
                'country_id' => 2,
                'image' => '1760519883_university__australian-institute-of-business-intelligence-aibi.jpg',
                'image_alt' => 'Australian Institute of Business Intelligence campus image',
                'name' => 'Australian Institute of Business Intelligence',
                'description' => 'Located at Suite 510, 451 Pitt Street, Haymarket, New South Wales 2000',
                'link' => 'https://faithoverseas.com/australian-institute-of-business-intelligence/',
                'created_at' => '2025-10-15 15:03:03',
                'updated_at' => '2025-10-16 13:42:22',
            ),
            44 => 
            array (
                'id' => 57,
                'country_id' => 3,
            'image' => '1760520907_Trent Sunset 2020-28 (1).jpg',
                'image_alt' => 'Trent University campus image',
                'name' => 'Trent University',
                'description' => 'Located at 1600 West Bank Drive, Peterborough, Ontario K9L 0G2',
                'link' => 'https://www.trentu.ca/',
                'created_at' => '2025-10-15 15:13:51',
                'updated_at' => '2025-10-16 13:38:55',
            ),
            45 => 
            array (
                'id' => 58,
                'country_id' => 3,
                'image' => '1760520846_fSkB8LJStKH5GR6kdOKpquzGVd1fzuuQWLU2tY6t.jpg',
                'image_alt' => 'University of Niagara Falls Canada campus image',
                'name' => 'University of Niagara Falls Canada',
                'description' => 'Located at 4342 Queen St, Niagara Falls, ON L2E 7J7',
                'link' => 'https://www.unfc.ca/',
                'created_at' => '2025-10-15 15:17:19',
                'updated_at' => '2025-10-16 13:40:05',
            ),
            46 => 
            array (
                'id' => 59,
                'country_id' => 2,
                'image' => '1760589681_images.jpg',
                'image_alt' => 'Stanley College campus image',
                'name' => 'Stanley College',
                'description' => 'Located at 69 Outram Street, West Perth, WA 6005',
                'link' => 'https://www.stanleycollege.edu.au/',
                'created_at' => '2025-10-16 10:26:21',
                'updated_at' => '2025-10-16 13:41:25',
            ),
            47 => 
            array (
                'id' => 60,
                'country_id' => 6,
                'image' => NULL,
                'image_alt' => NULL,
                'name' => 'University of Tokyo',
                'description' => 'Japan\'s top-ranked national university, located in Bunkyo, Tokyo',
                'link' => 'https://www.u-tokyo.ac.jp/en/',
                'created_at' => '2026-08-13 15:56:07',
                'updated_at' => '2026-08-13 15:56:07',
            ),
            48 => 
            array (
                'id' => 61,
                'country_id' => 6,
                'image' => NULL,
                'image_alt' => NULL,
                'name' => 'Kyoto University',
                'description' => 'One of Japan\'s most prestigious research universities, located in Kyoto',
                'link' => 'https://www.kyoto-u.ac.jp/en',
                'created_at' => '2026-08-13 15:56:07',
                'updated_at' => '2026-08-13 15:56:07',
            ),
            49 => 
            array (
                'id' => 62,
                'country_id' => 6,
                'image' => NULL,
                'image_alt' => NULL,
                'name' => 'Osaka University',
                'description' => 'A leading national university known for engineering and medicine, located in Osaka',
                'link' => 'https://www.osaka-u.ac.jp/en',
                'created_at' => '2026-08-13 15:56:07',
                'updated_at' => '2026-08-13 15:56:07',
            ),
            50 => 
            array (
                'id' => 63,
                'country_id' => 6,
                'image' => NULL,
                'image_alt' => NULL,
                'name' => 'Waseda University',
                'description' => 'One of Japan\'s most respected private universities, located in Shinjuku, Tokyo',
                'link' => 'https://www.waseda.jp/top/en',
                'created_at' => '2026-08-13 15:56:07',
                'updated_at' => '2026-08-13 15:56:07',
            ),
            51 => 
            array (
                'id' => 64,
                'country_id' => 6,
                'image' => NULL,
                'image_alt' => NULL,
                'name' => 'Ritsumeikan Asia Pacific University',
                'description' => 'A highly international campus located in Beppu, Oita',
                'link' => 'https://en.apu.ac.jp/home/',
                'created_at' => '2026-08-13 15:56:07',
                'updated_at' => '2026-08-13 15:56:07',
            ),
            52 => 
            array (
                'id' => 65,
                'country_id' => 6,
                'image' => NULL,
                'image_alt' => NULL,
                'name' => 'Tokyo University of Science',
                'description' => 'A leading science and engineering university located in Tokyo',
                'link' => 'https://www.tus.ac.jp/en/',
                'created_at' => '2026-08-13 15:56:07',
                'updated_at' => '2026-08-13 15:56:07',
            ),
        ));
        
        
    }
}