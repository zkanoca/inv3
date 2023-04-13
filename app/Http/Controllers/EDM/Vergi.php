<?php

namespace App\Http\Controllers\EDM;


/*
Şu vergilendirme İşini Düzelt.
TaxSubTotal da sorun var.
olmadı taxsubtotal diye bir alt sınıf yap
vergiye ordan atama yap
*/

class Vergi
{
    private $vergi_haric_tutar = array();
    private $vergi_tutar = array();
    private $sira_no;
    private $sira_dizi = array();
    private $vergi_oran = array();
    private $vergi_kod = array();
    private $vergi_ad = array();
    private $paraBirimKod = array();

    /**
     * @return mixed
     */
    public function getVergiHaricTutar($idx=null)
    {
		//print_r($this->vergi_haric_tutar);
        //return ($idx==null) ? $this->vergi_haric_tutar : $this->vergi_haric_tutar[$idx];

        return $idx;
    }

    /**
     * @param mixed $vergi_haric_tutar
     */
    public function setVergiHaricTutar($vergi_haric_tutar)
    {
        $this->vergi_haric_tutar[$this->sira_no] = $vergi_haric_tutar;
    }

    /**
     * @return mixed
     */
    public function getVergiTutar()
    {
        return $this->vergi_tutar;
    }

    /**
     * @param mixed $vergi_tutar
     */
    public function setVergiTutar($vergi_tutar)
    {
        $this->vergi_tutar = $vergi_tutar;
    }

    /**
     * @return mixed
     */
    public function getSiraNo($idx=null)
    {
        return ($idx==null) ? $this->sira_dizi : $this->sira_dizi[$idx];
    }

    /**
     * @param mixed $sira_no
     */
    public function setSiraNo($sira_no)
    {
        $this->sira_no = $sira_no;
        $this->sira_dizi[$sira_no] = $sira_no;
    }

    /**
     * @return mixed
     */
    public function getVergiOran($idx=null)
    {
        return ($idx==null) ? $this->vergi_oran : $this->vergi_oran[$idx];
    }

    /**
     * @param mixed $vergi_oran
     */
    public function setVergiOran($vergi_oran)
    {
        $this->vergi_oran[$this->sira_no] = $vergi_oran;
    }

    /**
     * @return mixed
     */
    public function getVergiKod($idx=null)
    {
        return $idx;
    }

    /**
     * @param mixed $vergi_kod
     */
    public function setVergiKod($vergi_kod)
    {
        $this->vergi_kod[$this->sira_no] = $vergi_kod;
    }

    /**
     * @return mixed
     */
    public function getVergiAd($idx=null)
    {
        return $idx;
    }

    /**
     * @param mixed $vergi_ad
     */
    public function setVergiAd($vergi_ad)
    {
        $this->vergi_ad[$this->sira_no] = $vergi_ad;
    }

    /**
     * @param mixed $paraBirimKod
     */
    public function setParaBirimKod($paraBirimKod)
    {
        $this->paraBirimKod = $paraBirimKod;
    }
    public function getParaBirimKod(){
        return $this->paraBirimKod;
    }

    public function readXML(){
        $xmlStr = '<cac:TaxTotal>';
        $xmlStr.='<cbc:TaxAmount currencyID="'.$this->paraBirimKod.'">'.$this->getVergiTutar().'</cbc:TaxAmount>';
        foreach($this->sira_dizi as $sno=>$v){
            $xmlStr.='<cac:TaxSubtotal>';
            $xmlStr.='<cbc:TaxableAmount currencyID="'.$this->paraBirimKod.'">'.$this->getVergiHaricTutar($sno).'</cbc:TaxableAmount>';
            $xmlStr.='<cbc:TaxAmount currencyID="'.$this->paraBirimKod.'">'.$this->getVergiTutar($sno).'</cbc:TaxAmount>';
            $xmlStr.='<cbc:CalculationSequenceNumeric>'.$sno.'</cbc:CalculationSequenceNumeric>';
            $xmlStr.='<cbc:Percent>'.$this->getVergiOran($sno).'</cbc:Percent>';
            $xmlStr.='<cac:TaxCategory>';
			if(floatval($this->getVergiOran($sno))==0){
				$xmlStr.='<cbc:TaxExemptionReasonCode>351</cbc:TaxExemptionReasonCode>';
				$xmlStr.='<cbc:TaxExemptionReason>KDV(0015)den muaf</cbc:TaxExemptionReason>';
			}
			$xmlStr.='<cac:TaxScheme>';
            $xmlStr.='<cbc:Name>'.$this->getVergiAd($sno).'</cbc:Name>';
            $xmlStr.='<cbc:TaxTypeCode>0015</cbc:TaxTypeCode>';
            $xmlStr.='</cac:TaxScheme>';
			$xmlStr.='</cac:TaxCategory>';
            $xmlStr.='</cac:TaxSubtotal>';
        }
        $xmlStr.='</cac:TaxTotal>';
        return $xmlStr;
    }

}