<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="site-section">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-lg-8 mb-5">
        <div class="p-5 bg-white border">
          <?if (!empty($arParams["~AUTH_RESULT"])):?>
            <div class="alert alert-info">
              <?=ShowMessage($arParams["~AUTH_RESULT"])?>
            </div>
          <?endif?>

          <?if (!empty($arResult['ERROR_MESSAGE'])):?>
            <div class="alert alert-danger">
              <?=ShowMessage($arResult['ERROR_MESSAGE'])?>
            </div>
          <?endif?>

          <form name="form_auth" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
            <input type="hidden" name="AUTH_FORM" value="Y" />
            <input type="hidden" name="TYPE" value="AUTH" />
            <?if ($arResult["BACKURL"] <> ''):?>
              <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
            <?endif?>
            <?foreach ($arResult["POST"] as $key => $value):?>
              <input type="hidden" name="<?=$key?>" value="<?=$value?>" />
            <?endforeach?>

            <div class="row form-group">
              <div class="col-md-12 mb-3 mb-md-0">
                <label class="font-weight-bold" for="USER_LOGIN"><?=GetMessage("AUTH_LOGIN")?></label>
                <input class="form-control" type="text" id="USER_LOGIN" name="USER_LOGIN" maxlength="255" value="<?=$arResult["LAST_LOGIN"]?>" />
              </div>
            </div>

            <div class="row form-group">
              <div class="col-md-12">
                <label class="font-weight-bold" for="USER_PASSWORD"><?=GetMessage("AUTH_PASSWORD")?></label>
                <input class="form-control" type="password" id="USER_PASSWORD" name="USER_PASSWORD" maxlength="255" autocomplete="off" />
                <?if($arResult["SECURE_AUTH"]):?>
                  <span class="bx-auth-secure" id="bx_auth_secure" title="<?echo GetMessage("AUTH_SECURE_NOTE")?>" style="display:none">
                    <div class="bx-auth-secure-icon"></div>
                  </span>
                  <noscript>
                    <span class="bx-auth-secure" title="<?echo GetMessage("AUTH_NONSECURE_NOTE")?>">
                      <div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
                    </span>
                  </noscript>
                  <script>
                    document.getElementById('bx_auth_secure').style.display = 'inline-block';
                  </script>
                <?endif?>
              </div>
            </div>

            <?if($arResult["CAPTCHA_CODE"]):?>
              <div class="row form-group">
                <div class="col-md-12">
                  <input type="hidden" name="captcha_sid" value="<?echo $arResult["CAPTCHA_CODE"]?>" />
                  <img src="/bitrix/tools/captcha.php?captcha_sid=<?echo $arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-12">
                  <label class="font-weight-bold" for="captcha_word"><?echo GetMessage("AUTH_CAPTCHA_PROMT")?>:</label>
                  <input class="form-control" type="text" id="captcha_word" name="captcha_word" maxlength="50" value="" autocomplete="off" />
                </div>
              </div>
            <?endif;?>

            <?if ($arResult["STORE_PASSWORD"] == "Y"):?>
              <div class="row form-group">
                <div class="col-md-12">
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="USER_REMEMBER" name="USER_REMEMBER" value="Y" />
                    <label class="form-check-label" for="USER_REMEMBER"><?=GetMessage("AUTH_REMEMBER_ME")?></label>
                  </div>
                </div>
              </div>
            <?endif?>

            <div class="row form-group">
              <div class="col-md-12">
                <input type="submit" class="btn btn-primary py-2 px-4 rounded-0" name="Login" value="<?=GetMessage("AUTH_AUTHORIZE")?>" />
              </div>
            </div>
          </form>

          <?if ($arParams["NOT_SHOW_LINKS"] != "Y"):?>
            <noindex>
              <p>
                <a href="<?=$arResult["AUTH_FORGOT_PASSWORD_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_FORGOT_PASSWORD_2")?></a>
              </p>
            </noindex>
          <?endif?>

          <?if($arParams["NOT_SHOW_LINKS"] != "Y" && $arResult["NEW_USER_REGISTRATION"] == "Y"):?>
            <noindex>
              <p>
                <a href="<?=$arResult["AUTH_REGISTER_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_REGISTER")?></a><br />
                <?=GetMessage("AUTH_FIRST_ONE")?>
              </p>
            </noindex>
          <?endif?>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
<?if ($arResult["LAST_LOGIN"] <> ''):?>
try{document.form_auth.USER_PASSWORD.focus();}catch(e){}
<?else:?>
try{document.form_auth.USER_LOGIN.focus();}catch(e){}
<?endif?>
</script>

<?if($arResult["AUTH_SERVICES"]):?>
<?
$APPLICATION->IncludeComponent("bitrix:socserv.auth.form", "",
  array(
    "AUTH_SERVICES" => $arResult["AUTH_SERVICES"],
    "CURRENT_SERVICE" => $arResult["CURRENT_SERVICE"],
    "AUTH_URL" => $arResult["AUTH_URL"],
    "POST" => $arResult["POST"],
    "SHOW_TITLES" => $arResult["FOR_INTRANET"]?'N':'Y',
    "FOR_SPLIT" => $arResult["FOR_INTRANET"]?'Y':'N',
    "AUTH_LINE" => $arResult["FOR_INTRANET"]?'N':'Y',
  ),
  $component,
  array("HIDE_ICONS"=>"Y")
);
?>
<?endif?>