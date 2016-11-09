<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use App\Libraries\Cargo\Arax;

class TestController extends Controller
{

    public function getIndex()
    {

        $orders_no="";

        $aras=new Arax();
        $aras->setUsername("TEST USERNAME");
        $aras->setPassword("TEST PASSWORD");
        $aras->setURL("http://customerservicestest.araskargo.com.tr/arascargoservice/arascargoservice.asmx");

        $aras->setIntegrationCode($orders_no);
        $aras->setInvoiceNumber($orders_no);
        $aras->setTradingWaybillNumber($orders_no);
        $aras->setPieceCount("1");
        $aras->setDescription("TANIM");

        $aras->setReceiverName("AD SOYAD");
        $aras->setReceiverPhone1("05344516488");

        $aras->setReceiverTownName("GAZİOSMANPAŞA");
        $aras->setReceiverAddress("adres");
        $aras->setReceiverCityName("şehir");
        $aras->setIsWorldWide("0");

        $result=$aras->check();
        /*
        Return array(2) {
          ["ResultCode"]=>
          string(1) "0"
          ["ResultMessage"]=>
          string(11) "Başarılı"
        }
        */
        
        if ($result["ResultCode"]==0)
        {
              # başarılı işlem...
        }
        else
        {
              # başarısız işlem
              /*
                Kaydet
              */  
        }        
    }
}
