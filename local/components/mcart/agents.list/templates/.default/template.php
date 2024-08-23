<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

echo '<pre>';
print_r($arResult); // для разработки в конечном коде убрать
echo '</pre>';
?>
<div class="site-section site-section-sm bg-light">
    <div class="container agents-list">
        <div class="row mb-5">
            <div class="col-12">
                <div class="site-section-title">
                    <h2>Агенты по Недвижимости</h2>
                </div>
            </div>
        </div>
        <div class="mb-5">
            <?php if (!empty($arResult['AGENTS']['ITEMS'])): ?>
                <?php foreach ($arResult['AGENTS']['ITEMS'] as $agent): ?>
                    <div class="agent__card">
                        <div class="small-info">
                            <div class="avatar" style="background-image: url(<?= !empty($agent['UF_PHOTO_PATH']) ? $agent['UF_PHOTO_PATH'] : $this->GetFolder() . '/images/no-avatar.png' ?>);"></div>
                            <div class="info">
                                <div class="name"><?= $agent['UF_FULL_NAME'] ?></div>
                            </div>
                        </div>
                        <div class="agent__card_item">
                            <div class="agent__card_info">
                                <div class="card__info_item">
                                    <div class="position">Электронная почта: </div>
                                    <div class="name"><?= $agent['UF_EMAIL'] ?></div>
                                </div>
                                <div class="card__info_item">
                                    <div class="position">Телефон: </div>
                                    <div class="name"><?= $agent['UF_PHONE'] ?></div>
                                </div>
                                <div class="card__info_item">
                                    <div class="position">Вид деятельности:</div>
                                    <div class="name"><?php if (!empty($agent['UF_ACTIVITY_TYPE_VALUE']) && is_array($agent['UF_ACTIVITY_TYPE_VALUE'])) { 
                                        echo implode(', ', $agent['UF_ACTIVITY_TYPE_VALUE']);
                                        } else 
                                        { echo $agent['UF_ACTIVITY_TYPE_VALUE'] ?? ''; } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a class="star <?= in_array($agent['ID'], $arResult['STAR_AGENTS']) ? 'active' : '' ?>" data-agent-id="<?= $agent['ID'] ?>">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 4L14.472 9.26604L20 10.1157L16 14.2124L16.944 20L12 17.266L7.056 20L8 14.2124L4 10.1157L9.528 9.26604L12 4Z" stroke="#95929A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Агентов не найдено.</p>
            <?php endif; ?>
        </div>

        <?php
        $APPLICATION->IncludeComponent(
            "bitrix:main.pagenavigation",
            ".default",
            array(
                "NAV_OBJECT" => $arResult['AGENTS']['NAV_OBJECT'],
                "SEF_MODE" => "N",
            ),
            false
        );
        ?>
    </div>
</div>



