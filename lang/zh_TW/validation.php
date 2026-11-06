<?php

return [
    'required' => ':attribute 為必填項目。',
    'min' => [
        'string' => ':attribute 長度至少需要 :min 個字元。',
    ],
    'confirmed' => ':attribute 兩次輸入不一致。',
    'unique' => '該 :attribute 已經被使用。',
    'email' => ':attribute 必須是有效的電子郵件格式。',

    // 將欄位名稱轉譯成繁體中文
    'attributes' => [
        'name' => '姓名',
        'email' => '電子郵件',
        'password' => '密碼',
        'password_confirmation' => '確認密碼',
        'title' => '電影名稱',
        'director' => '導演',
        'release_year' => '上映年份',
        'genre_id' => '電影類型',
    ],
];