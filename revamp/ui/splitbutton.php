<?php 
$mainButtonText = "Split Button";
$mainButtonBehaviour = "button";
$mainButtonClasses = "";
$actionButtonClasses = "";
$style = "primary";
$buttonThemes = [
    "primary" => "btn-primary",
    "danger"  => "btn-danger"
];

if (isset($splitButtonData) && !empty($splitButtonData))
{
    extract($splitButtonData);
}

$buttonTheme = $buttonThemes[$style];

?>
<div class="btn-group split-button">
    <button type="<?= $mainButtonBehaviour ?>" class="btn split-button-main <?= implode(' ', [$buttonTheme, $mainButtonClasses]) ?>"><?= $mainButtonText ?></button>
    <button type="button" class="btn split-button-actions <?= implode(' ', [$buttonTheme, $actionButtonClasses]) ?>">
        <!-- <span class="sr-only">Toggle Dropdown</span> -->
         <i class="fa fa-id-badge"></i>
    </button>
</div>


<style>
    .split-button .split-button-main {
        color: white;
        border-top-left-radius: 4px;
        border-bottom-left-radius: 4px;
    }

    .split-button .split-button-main.btn-primary {
        background: var(--primary);
    }

    .split-button .split-button-actions {
        width: 38px;
        color: #fff;
        border-top-right-radius: 4px;
        border-bottom-right-radius: 4px;
    }

    .split-button .split-button-actions.btn-primary {
        background-color: #0069d9;
        border-color: #0062cc;
    }

    .split-button .split-button-actions.btn-danger {
        background-color: #C82333;
        border-color: #BD2130;
    }

    .split-button:hover .split-button-main.btn-primary {
        background-color: #17a2b8;
        border-color: #117a8b;
    }

    .split-button:hover .split-button-actions.btn-primary
    {
        background-color: #138496;
        border-color: #117a8b;
    }
</style>