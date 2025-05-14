<?php

namespace App\Enums;

use App\Traits\EnumToArrayTrait;

enum ParentProductCategoryEnum: string
{
    use EnumToArrayTrait;

    case INDAGINI_DIAGNOSTICHE = 'Indagini Diagnostiche';
    case PROVE_SU_MATERIALI_DA_COSTRUZIONE = 'Prove su materiali da costruzione';
    case VESTIARIO = 'Vestiario';
    case SOFTWARE = 'Software';
    case DIAGNOTICA_STRUTTURALE = 'Diagnotica strutturale';
    case RILIEVI_E_MONITORAGGI = 'Rilievi e monitoraggi';
    case MONITORAGGIO_E_ANALISI_VIBRAZIONALE = 'Monitoraggio e analisi vibrazionale';
    case MONITORAGGIO_AMBIENTALE = 'Monitoraggio Ambientale';
    case RILIEVO = 'Rilievo';
    case VERIFICHE_E_CONTROLLI = 'Verifiche e controlli';
    case PROVE_DI_CARICO = 'Prove di carico';
    case PROVE_SPECIALI = 'Prove speciali';
    case PROVE_CHIMICHE_E_ARCHEOMETRICHE = 'Prove chimiche e archeometriche sui materiali';
    case CONSERVAZIONE_BENI_CULTURALI = 'Conservazione dei beni culturali e archeologici';
    case MONITORAGGIO_MICRO_AMBIENTALE = 'Monitoraggio micro ambientale';
    case GEOGNOSTICA_E_FONDAZIONI = 'Geognostica e fondazioni';
    case RELAZIONI = 'Relazioni';
    case NOLI = 'Noli';
    case SICUREZZA = 'Sicurezza';
    case ALTRO = 'Altro';

}

