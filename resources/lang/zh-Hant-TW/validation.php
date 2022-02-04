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
        'numeric' => 'The :attribute must be less than :value.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'string' => 'The :attribute must be less than :value characters.',
        'array' => 'The :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'The :attribute must be less than or equal to :value.',
        'file' => 'The :attribute must be less than or equal to :value kilobytes.',
        'string' => 'The :attribute must be less than or equal to :value characters.',
        'array' => 'The :attribute must not have more than :value items.',
    ],
    'max' => [
        'numeric' => 'The :attribute must not be greater than :max.',
        'file' => 'The :attribute must not be greater than :max kilobytes.',
        'string' => 'The :attribute must not be greater than :max characters.',
        'array' => 'The :attribute must not have more than :max items.',
    ],
    'mimes' => 'The :attribute must be a file of type: :values.',
    'mimetypes' => 'The :attribute must be a file of type: :values.',
    'min' => [
        'numeric' => 'The :attribute must be at least :min.',
        'file' => 'The :attribute must be at least :min kilobytes.',
        'string' => 'The :attribute must be at least :min characters.',
        'array' => 'The :attribute must have at least :min items.',
    ],
    'multiple_of' => 'The :attribute must be a multiple of :value.',
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'The :attribute format is invalid.',
    'numeric' => 'The :attribute must be a number.',
    'password' => 'The password is incorrect.',
    'present' => 'The :attribute field must be present.',
    'prohibited' => 'The :attribute field is prohibited.',
    'prohibited_if' => 'The :attribute field is prohibited when :other is :value.',
    'prohibited_unless' => 'The :attribute field is prohibited unless :other is in :values.',
    'prohibits' => 'The :attribute field prohibits :other from being present.',
    'regex' => 'The :attribute format is invalid.',
    'required' => 'The :attribute field is required.',
    'required_if' => 'The :attribute field is required when :other is :value.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => 'The :attribute field is required when :values is present.',
    'required_with_all' => 'The :attribute field is required when :values are present.',
    'required_without' => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same' => 'The :attribute and :other must match.',
    'size' => [
        'numeric' => 'The :attribute must be :size.',
        'file' => 'The :attribute must be :size kilobytes.',
        'string' => 'The :attribute must be :size characters.',
        'array' => 'The :attribute must contain :size items.',
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values.',
    'string' => 'The :attribute must be a string.',
    'timezone' => 'The :attribute must be a valid timezone.',
    'unique' => 'The :attribute has already been taken.',
    'uploaded' => 'The :attribute failed to upload.',
    'url' => 'The :attribute must be a valid URL.',
    'uuid' => 'The :attribute must be a valid UUID.',

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
