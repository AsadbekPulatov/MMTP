<?php


namespace App\Http\Service;

class number_to_word{
    public function number_to_word($number)
    {
        $length = strlen($number);
        $new_word = '';
        $slice = $length % 3;
        if ($slice == 0) {
            $slice = 3;
        }
        for ($i = $slice; $i < 3; $i++)
            $number = '0' . $number;
        $length = strlen($number);
        $index = 0;
        while ($length > 0) {
            $slice_number = substr($number, $index, 3);
            $n_100 = $slice_number[0];
            $n_10 = $slice_number[1];
            $n_1 = $slice_number[2];
            switch ($n_100) {
                case 1:
                    $new_word .= 'Бир Юз ';
                    break;
                case 2:
                    $new_word .= 'Икки Юз ';
                    break;
                case 3:
                    $new_word .= 'Уч Юз ';
                    break;
                case 4:
                    $new_word .= 'Турт Юз ';
                    break;
                case 5:
                    $new_word .= 'Беш Юз ';
                    break;
                case 6:
                    $new_word .= 'Олти Юз ';
                    break;
                case 7:
                    $new_word .= 'Етти Юз ';
                    break;
                case 8:
                    $new_word .= 'Саккиз Юз ';
                    break;
                case 9:
                    $new_word .= 'Туккиз Юз ';
                    break;
            }
            switch ($n_10) {
                case 1:
                    $new_word .= 'Ун ';
                    break;
                case 2:
                    $new_word .= 'Йигирма ';
                    break;
                case 3:
                    $new_word .= 'Уттиз ';
                    break;
                case 4:
                    $new_word .= 'Кирк ';
                    break;
                case 5:
                    $new_word .= 'Эллик ';
                    break;
                case 6:
                    $new_word .= 'Олтмиш ';
                    break;
                case 7:
                    $new_word .= 'Етмиш ';
                    break;
                case 8:
                    $new_word .= 'Саксон ';
                    break;
                case 9:
                    $new_word .= 'Туксон ';
                    break;
            }
            switch ($n_1) {
                case 1:
                    $new_word .= 'Бир';
                    break;
                case 2:
                    $new_word .= 'Икки';
                    break;
                case 3:
                    $new_word .= 'Уч';
                    break;
                case 4:
                    $new_word .= 'Турт';
                    break;
                case 5:
                    $new_word .= 'Беш';
                    break;
                case 6:
                    $new_word .= 'Олти';
                    break;
                case 7:
                    $new_word .= 'Етти';
                    break;
                case 8:
                    $new_word .= 'Саккиз';
                    break;
                case 9:
                    $new_word .= 'Туккиз';
                    break;
            }
            switch ($length) {
                case 4:
                    $new_word .= ' Минг ';
                    break;
                case 5:
                    $new_word .= ' Минг ';
                    break;
                case 6:
                    $new_word .= ' Минг ';
                    break;
                case 7:
                    $new_word .= ' Миллион ';
                    break;
                case 8:
                    $new_word .= ' Миллион ';
                    break;
                case 9:
                    $new_word .= ' Миллион ';
                    break;
                case 10:
                    $new_word .= ' Миллиард ';
                    break;
                case 11:
                    $new_word .= ' Миллиард ';
                    break;
                case 12:
                    $new_word .= ' Миллиард ';
                    break;
            }
            $length -= 3;
            $index += 3;
        }
        $new_word = mb_strtoupper($new_word, "utf-8");
        return $new_word;
    }
}
