<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<? foreach ($arResult['ITEMS'] as &$arItem) {
    $place = CIBlockElement::GetByID($arItem['PROPERTIES']['place']['VALUE'])->Fetch();
    $arItem['PLACE_NAME'] = $place['NAME'];

    $company = CUser::GetByID(CIBlockElement::GetByID($arItem['PROPERTIES']['company']['VALUE']))->Fetch();
    $arItem['COMPANY'] = $company['NAME'];
}
?>