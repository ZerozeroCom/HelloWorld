<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => '此 :attribute 必須被接受。',
    'accepted_if' => '當 :other 是 :value 時，必須接受 :attribute。',
    'active_url' => '此 :attribute 不是有效的 URL。',
    'after' => '此 :attribute 必須是 :date 之後的日期。',
    'after_or_equal' => '此 :attribute 必須是晚於或等於 :date 的日期。',
    'alpha' => '此 :attribute 只能包含字母。',
    'alpha_dash' => '此 :attribute 只能包含字母、數字、破折號和下劃線。',
    'alpha_num' => '此 :attribute 只能包含字母和數字。',
    'array' => '此 :attribute 必須是一個陣列。',
    'before' => '此 :attribute 必須是 :date 之前的日期。',
    'before_or_equal' => '此 :attribute 必須是早於或等於 :date 的日期。',
    'between' => [
        'numeric' => '此 :attribute 必須介於 :min 和 :max 之間。',
        'file' => '此 :attribute 必須介於 :min 和 :max kb之間。',
        'string' => '此 :attribute 必須介於 :min 和 :max 字元之間。',
        'array' => '此 :attribute 必須介於 :min 和 :max 項之間。',
    ],
    'boolean' => '此 :attribute 字段必須為布林值：真或假。',
    'confirmed' => '此 :attribute 確認不匹配。',
    'current_password' => '密碼不正確。',
    'date' => '此 :attribute 不是有效日期。',
    'date_equals' => '此 :attribute 必須是等於 :date 的日期。',
    'date_format' => '此 :attribute 與格式 :format 不匹配。',
    'declined' => '此 :attribute 必須被拒絕。',
    'declined_if' => '當 :other 是 :value 時，必須拒絕此 :attribute。',
    'different' => '此 :attribute 和 :other 必須不同。',
    'digits' => '此 :attribute 必須是 :digits 數字。',
    'digits_between' => '此 :attribute 必須介於 :min 和 :max 數字之間。',
    'dimensions' => '此 :attribute 具有無效的圖像尺寸。',
    'distinct' => '此 :attribute 字段具有重複值。',
    'email' => '此 :attribute 必須是有效的電子郵件地址。',
    'ends_with' => '此 :attribute 必須以下列之一結尾： :values。',
    'enum' => '選擇的此 :attribute 屬性無效。',
    'exists' => '選擇的此 :attribute 屬性無效。',
    'file' => '此 :attribute 必須是一個檔案。',
    'filled' => '此 :attribute 字段必須有一個值。',
    'gt' => [
        'numeric' => '此 :attribute 必須大於 :value。',
        'file' => '此 :attribute 必須大於 :value kb。',
        'string' => '此 :attribute 必須大於 :value 字符。',
        'array' => '此 :attribute 必須多於 :value 項。',
    ],
    'gte' => [
        'numeric' => '此 :attribute 必須大於或等於 :value。',
        'file' => '此 :attribute 必須大於或等於 :value kb。',
        'string' => '此 :attribute 必須大於或等於 :value 字元。',
        'array' => '此 :attribute 必須有 :value 項或更多項。',
    ],
    'image' => '此 :attribute 必須是圖像。',
    'in' => '選擇的 :attribute 無效。',
    'in_array' => ' :other 中不存在此 :attribute 字段。',
    'integer' => '此 :attribute 必須是整數。',
    'ip' => '此 :attribute 必須是有效的 IP 地址。',
    'ipv4' => '此 :attribute 必須是有效的 IPv4 地址。',
    'ipv6' => '此 :attribute 必須是有效的 IPv6 地址。',
    'mac_address' => '此 :attribute 必須是有效的 MAC 地址。',
    'json' => '此 :attribute 必須是有效的 JSON 字串。',
    'lt' => [
        'numeric' => '此 :attribute 必須小於 :value。',
        'file' => '此 :attribute 必須小於 :value kb。',
        'string' => '此 :attribute 必須小於 :value 字符。',
        'array' => '此 :attribute 必須少於 :value 項。',
    ],
    'lte' => [
        'numeric' => '此 :attribute 必須小於或等於 :value。',
        'file' => '此 :attribute 必須小於或等於 :value kb。',
        'string' => '此 :attribute 必須小於或等於 :value 字元。',
        'array' => '此 :attribute 必須等於 :value 項或更少項。',
    ],
    'max' => [
        'numeric' => '此 :attribute 不能大於 :max。',
        'file' => '此 :attribute 不能大於 :max kb。',
        'string' => '此 :attribute 不能大於 :max 字元。',
        'array' => '此 :attribute 不能大於 :max 項。',
    ],
    'mimes' => '此 :attribute 必須是類型為： :values 的檔案。',
    'mimetypes' => '此 :attribute 必須是類型為： :values 的檔案。',
    'min' => [
        'numeric' => '此 :attribute 必須至少為 :min。',
        'file' => '此 :attribute 必須至少為 :min kb。',
        'string' => '此 :attribute 必須至少為 :min 個字元。',
        'array' => '此 :attribute 必須至少有 :min 項。',
    ],
    'multiple_of' => '此 :attribute 必須是 :value 的倍數。',
    'not_in' => '選擇的此 :attribute 無效。',
    'not_regex' => '此 :attribute 格式無效。',
    'numeric' => '此 :attribute 必須是一個數字。',
    'password' => '密碼不正確。',
    'present' => '此 :attribute 字段必須存在。',
    'prohibited' => '此 :attribute 字段被禁止。',
    'prohibited_if' => '當 :other 為 :value 時，禁止使用此 :attribute 字段。',
    'prohibited_unless' => '此 :attribute 字段是禁止的，除非 :other 在 :values 中。',
    'prohibits' => '此 :attribute 字段禁止 :other 出現。',
    'regex' => '此 :attribute 格式無效。',
    'required' => '此 :attribute 字段是必需的。',
    'required_if' => '當 :other 是 :value 時需要此 :attribute 字段。',
    'required_unless' => '此 :attribute 字段是必需的，除非 :other 在 :values 中。',
    'required_with' => '存在 :values 時需要此  :attribute 字段。',
    'required_with_all' => '存在 :values 時需要此 :attribute 字段們。',
    'required_without' => '當 :values 不存在時，需要此 :attribute 字段。',
    'required_without_all' => '當 :value 為空時，需要 :attribute 字段。',
    'same' => '此 :attribute 和 :other 必須匹配。',
    'size' => [
        'numeric' => '此 :attribute 必須是 :size。',
        'file' => '此 :attribute 必須是 :size kb。',
        'string' => '此 :attribute 必須是 :size 字元。',
        'array' => '此 :attribute 必須包含 :size 項。',
    ],
    'starts_with' => '此 :attribute 必須以下列之一開頭： :values 。',
    'string' => '此 :attribute 必須是字串。',
    'timezone' => '此 :attribute 必須是有效的時區。',
    'unique' => '此 :attribute 已被佔用。',
    'uploaded' => '此 :attribute 上傳失敗。',
    'url' => '此 :attribute 必須是有效的 URL。',
    'uuid' => '此 :attribute 必須是有效的 UUID。',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
