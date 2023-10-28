<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Home Page Resource Icon Box
    |--------------------------------------------------------------------------*/

    'header_menu' => [
    	['label'=>'Home',   'route'=>'page.index'],
    	['label'=>'Personalized Flyer',   'route'=>'getmydp'],
    	['label'=>'Testimonies',  'route'=>'home'],
    	['label'=>'Resources',   'route'=>'home'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Home Page Resource Icon Box
    |--------------------------------------------------------------------------*/

    'resources' => [
    	['title_1'=>'Download events', 'title_2'=>'RESOURCES', 'icon'=>'fa-file-pdf', 'route'=>'home'],
    	['title_1'=>'Create Personalized', 'title_2'=>'FLYERS', 'icon'=>'fa-file-image', 'route'=>'home'],
    	['title_1'=>'Share Your', 'title_2'=>'TESTIMONIES', 'icon'=>'fa-microphone', 'route'=>'home'],
    	['title_1'=>'Download events', 'title_2'=>'RESOURCES', 'icon'=>'fa-file-pdf', 'route'=>'home'],
    ],


    /*
    |--------------------------------------------------------------------------
    | Home Page Testimonies
    |--------------------------------------------------------------------------*/

    'testimonies' => [
    	[
    		'name'=>'Adedigba Omolaso', 'location'=>'Abuja, Nigeria', 'image'=>'news1.jpg',
    		'title'=>'Healed of a Sharp Pain',
    		'text'=>'On the 1st of April, she experienced a sharp pain after trying to put a baby down. She got home and felt the pain again. Someone researched online and told her that this kind of pain is associated with kidney disease. She ignored it and believed in God for her healing. During the Easter Retreat, after the message on Jesus, Our Passover, The man of God prayed specifically for people experiencing internal problems. She received her healing and was made whole. The pain has not returned since then. Praise the Lord!'
    	],
    	[
    		'name'=>'Esther Yohana', 'location'=>'Lagos, Nigeria', 'image'=>'news2.jpg',
    		'title'=>'Sharp Pain Healed',
    		'text'=>'The man of God prayed specifically for people experiencing internal problems. She received her healing and was made whole. The pain has not returned since then .On the 1st of April, she experienced a sharp pain after trying to put a baby down. She got home and felt the pain again. Someone researched online and told her that this kind of pain is associated with kidney disease. She ignored it and believed in God for her healing. During the Easter Retreat, after the message on Jesus, Our Passover. Praise the Lord!'
    	],
    ],

    /*
    |--------------------------------------------------------------------------
    | Home Page Program schedule
    |--------------------------------------------------------------------------*/

    'schedules' => [
        'crusade' => [
                'name'=>'EVENING CRUSADES',
                'days' => '27',
                'month' => 'APRIL',
                'image' => '/assets/img/event-img/asg.jpg',
                'list' => [
                    ['time' => '05:30PM', 'event' => 'Prelude Activities/Instrumental', 'speakers' => ''],
                    ['time' => '05:50PM', 'event' => 'Opening Prayer', 'speakers' => ''],
                    ['time' => '05:55PM', 'event' => 'Congregation Song', 'speakers' => ''],
                    ['time' => '06:00PM', 'event' => 'Intercession for Total Emancipation', 'speakers' => ''],
                    ['time' => '06:10PM', 'event' => 'Announcements', 'speakers' => ''],
                    ['time' => '06:15PM', 'event' => 'Choir from Nations', 'speakers' => ''],
                    ['time' => '06:25PM', 'event' => 'Testimonies', 'speakers' => ''],
                    ['time' => '06:35PM', 'event' => 'Alpha Location Choir', 'speakers' => ''],
                    ['time' => '06:40PM', 'event' => 'Music Minister', 'speakers' => ''],
                    ['time' => '07:00PM', 'event' => 'GS Ministration', 'speakers' => ''],
                ]
            ],

        'min_confe' =>  [
            'name'=>'MINISTERS CONFERENCE',
            'days' => '21, 22, 24 & 25',
            'month' => 'APRIL',
            'image' => '/assets/img/event-img/zambia_banner.jpg',
            'list' => [
                ['time' => '05:30PM', 'event' => 'Prelude Activities/Instrumental', 'speakers' => ''],
                ['time' => '05:50PM', 'event' => 'Opening Prayer', 'speakers' => ''],
                ['time' => '05:55PM', 'event' => 'Congregation Song', 'speakers' => ''],
                ['time' => '06:00PM', 'event' => 'Intercession for Total Emancipation', 'speakers' => ''],
                ['time' => '06:10PM', 'event' => 'Announcements', 'speakers' => ''],
                ['time' => '06:15PM', 'event' => 'Choir from Nations', 'speakers' => ''],
                ['time' => '06:25PM', 'event' => 'Testimonies', 'speakers' => ''],
                ['time' => '06:35PM', 'event' => 'Alpha Location Choir', 'speakers' => ''],
                ['time' => '06:40PM', 'event' => 'Music Minister', 'speakers' => ''],
                ['time' => '07:00PM', 'event' => 'GS Ministration', 'speakers' => ''],
            ]
        ],
        'impact' =>  [
            'name'=>'IMPACT ACADEMY',
            'days' => '22',
            'month' => 'APRIL',
            'image' => '/assets/img/event-img/asg.jpg',
            'list' => [
                ['time' => '05:30PM', 'event' => 'Prelude Activities/Instrumental', 'speakers' => ''],
                ['time' => '05:50PM', 'event' => 'Opening Prayer', 'speakers' => ''],
                ['time' => '05:55PM', 'event' => 'Congregation Song', 'speakers' => ''],
                ['time' => '06:00PM', 'event' => 'Intercession for Total Emancipation', 'speakers' => ''],
                ['time' => '06:10PM', 'event' => 'Announcements', 'speakers' => ''],
                ['time' => '06:15PM', 'event' => 'Choir from Nations', 'speakers' => ''],
                ['time' => '06:25PM', 'event' => 'Testimonies', 'speakers' => ''],
                ['time' => '06:35PM', 'event' => 'Alpha Location Choir', 'speakers' => ''],
                ['time' => '06:40PM', 'event' => 'Music Minister', 'speakers' => ''],
                ['time' => '07:00PM', 'event' => 'GS Ministration', 'speakers' => ''],
            ]
        ],

    ],


];
