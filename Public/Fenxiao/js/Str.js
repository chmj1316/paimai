
//------------- װ���б� -------------//
var LoadStr="<div style='width:100%;padding:20px 0px 20px 0px;text-align:center;'>\u6b63\u5728\u88c5\u8f7d ...</div>";
var AJAX_ContentList="ContentList";
//��ʾ��������ID
var AJAX_PagesInfoStr="PagesInfoStr";
//��ʾҳ��ϢID
var Pfun;
//��ҳ������
var IsAll=true;
//�Ƿ���ʾȫ��
var LoadContent=false;
//�Ƿ���ʾ��������
var SoTitle="";
//��������
var SearchType="0";
//��������
var ExecFun="";
var Other="";
var OtherTag="";
var OrderType=1;
var OrderFieldName="";
var CheckType="0";
var LoadCompleted="_LoadCompleted()";
//����װ����ɺ��¼�
//����,ҳ����
function LoadPageList(type,PageIndex)
{
    
	//this.Other=window.location.search;
	var column=RequestByName("column");
	var value=RequestByName("value");
	if(column!="")
	{
		this.Other=column+","+value;
	}
	try
	{
		$1("Loading").style.left=(document.body.clientWidth-100)/2+"px";
		$1("Loading").style.display="";
	}
	catch(e)
	{
	}
	var Query = new Array(PageIndex, this.SoTitle, this.SearchType, this.OrderFieldName, this.OrderType, this.AddPage, this.CheckType, this.Other, this.OtherTag);

	ExecAJ(type, Query, "PageList");
}
function PageList(text,parameter,query,type)
{
	document.getElementById(this.AJAX_ContentList).innerHTML=text;
	try
	{
		$1("Loading").style.display="none";
	}
	catch(e)
	{
	}
	if(this.IsLoad==false)
	{
		LoadShowPageInfo(type,query);
	}
	if(this.LoadCompleted!=""&&this.LoadCompleted!=null)
	{
		try
		{
			eval(this.LoadCompleted);
		}
		catch(e)
		{
		}
	}
}
function LoadShowPageInfo(type,query)
{
	type=type+"_PageInfo";
	ExecAJ(type,query,"ShowPageInfo");
}
function ShowPageInfo(text)
{
	if(text=="")
	return ;
	load("A","B",this.Pfun+"",text);
}
function LoadPage(fun,V)
{
	if(V=="")
	return ;
	load("A","B",fun,V);
}




 function OrderFun(OrderField, Index) {
   
       GetOrderList(OrderField,Index);
  }



  //��ʼ��Ĭ������ 2013-04-30
  function OrderInitial(OrderField, orderType) {
      if (OrderField != "") {
          var F = new Array(OrderField, OrderField);

          if (OrderField.indexOf("|") > 0) {
              var F = OrderField.split("|");
          }

          this.OrderFieldName = F[1];

          this.OrderType = orderType;
      }
  }

  function GetOrderList(OrderField, Index) {
      var F = new Array(OrderField, OrderField);

      if (OrderField.indexOf("|") > 0) {
          var F = OrderField.split("|");
      }

      this.OrderFieldName = F[1];


      var value = $1("Desc" + F[0] + "_" + Index);

      if (value.style.display == "none") {
          this.OrderType = 1;
      }
      else {
          this.OrderType = value.getAttribute("name");
      }

      $1("Go").value = $1("CPage").innerHTML = this.Page = 1;


      //eval(this.Pfun+"(1)");
      Load();


  }
  
  function _LoadCompleted()
  {
   try
   {
   AutoTableHeight();//���100%
   }
   catch(e)
   {}
  }
