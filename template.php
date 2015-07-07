<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?
// номер текущей страницы
$curPage = $arResult["NAV_RESULT"]->NavPageNomer;
// всего страниц - номер последней страницы
$totalPages = $arResult["NAV_RESULT"]->NavPageCount;
// номер постраничной навигации на странице
$navNum = $arResult["NAV_RESULT"]->NavNum;
//всего новостей
$totalNews = $arResult["NAV_RESULT"]->NavRecordCount;
//выводить на страницк
$onPage = $arResult["NAV_RESULT"]->NavPageSize;
?>

<? if ($arParams["AJAX"] != "Y"): ?>
<div class="help_now">
    <div class="sub_container">
        <h2><a href="#">Сейчас нуждаются в помощи</a></h2>

        <p class="about">В этом списке — те, кто нуждаются в помощи прямо сейчас.
            Просто выберите, как вы хотите помочь,<br/> заполните поля появившейся формы,
            и наш оператор свяжется с вами.</p>
        <table class="big_table" id="last_request_mp">
            <tbody>
            <? endif; ?>
            <? foreach ($arResult["ITEMS"] as $arItem): ?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <tr class="news-item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                    <td class="hn_name"><a href="#" class="bd"><span><?= $arItem['COMPANY'] ?></span></a></td>
                    <td class="hn_mess"><?= $arItem['NAME'] ?></td>
                    <td class="hn_city"><?= $arItem["PLACE_NAME"] ?></td>
                </tr>
            <? endforeach; ?>

            <? if ($arParams["AJAX"] != "Y"): ?>
            </tbody>
        </table>
        <? endif; ?>

        <? if ($arParams["AJAX"] != "Y"): ?>
        <table class="big_table" id="show-more">
            <tbody>
            <tr>
                <td colspan="3" id="load-items">
                    <span class="more_10">Показать еще <span class="cnt"><?= $arResult['NAV_RESULT']->NavPageSize; ?></span></span>
                    <a href="#" class="all_list">Перейти в полный список</a>
                </td>
            </tr>
            </tr>
            </tbody>
        </table>
    </div>
</div>
    <script>
        $(function () {
            var newsSetLoader = new newsLoader({
                root: '#last_request_mp',
                newsBlock: 'tbody',
                newsLoader: '#load-items',
                parentLoader: '#show-more',
                cntMore: '.more_10 .cnt',
                loadSett: {
                    endPage: <?= $totalPages ?>,
                    navNum: <?= $navNum ?>,
                    totalNum: <?= $totalNews ?>,
                    curPage: <?= $curPage ?>,
                    onPage: <?= $onPage ?>
                }
            });
            newsSetLoader.init();
        });
    </script>


<? endif; ?>
