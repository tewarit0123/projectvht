<?php

return array(
    'fontDir' => storage_path('fonts/'), // ตำแหน่งที่เก็บไฟล์ font metrics
    'fontCache' => storage_path('fonts/'),
    'defaultFont' => 'THSarabunNew',
    'isRemoteEnabled' => true,
    
    'chroot' => [
        base_path('public/fonts'),    // ตำแหน่งที่เก็บไฟล์ font จริง
        storage_path('fonts'),
    ],
); 