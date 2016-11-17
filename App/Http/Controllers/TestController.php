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
        
        $aras->setReceiverName("AD SOYAD");
        $aras->setReceiverPhone1("05344516488");
        $aras->setReceiverTownName("GAZİOSMANPAŞA");
        $aras->setReceiverAddress("adres");
        $aras->setReceiverCityName("şehir");
        $aras->setIsWorldWide("0");
        $aras->setDescription("Online Ticaret");

        $aras->setCodCollectionType(0);//Tahsilatlı teslimat ürünü ödeme tipi (0=Nakit,1=Kredi Kartı)
        $aras->setPayorTypeCode(1);//Gönderinin ödemesini kimin yapacağını belirler. (1=Gönderici Öder, 2=Alıcı Öder)
        $aras->setCodAmount(127.10);
        $aras->setIsCod(1);//IsCod  String(1)   'Tahsilatlı Kargo' gönderisi (0=Hayır, 1=Evet)  Hayır
        $aras->setPieceCount(2);//PieceCount    Integer(2)  Sevkedilen Kargo Sayısı

        $items=array();
        $item_1=[
            "BarcodeNumber"=>$orders_no.rand(20,25),
        ];
        $item_2=[
            "BarcodeNumber"=>$orders_no.rand(30,35),
        ];
        $items[]=$item_1;
        $items[]=$item_2;

        $aras->setPieceDetail($items);


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
