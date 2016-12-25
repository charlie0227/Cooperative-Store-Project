require(["jquery.min","kendo.all.min"],function(){
	$(function(){
		$.post("function/search_bar.php",
		{
		  datatype:'json'
		},
		function(data){
			var temp='{"list":'+data+'}';
			var obj=JSON.parse(temp);
			var availableTags=[];
			var arr = new Array();
			for(var i=0;i<obj.list.length;i++){
				var obj_tmp = new Object;
				obj_tmp.name = obj.list[i].name;
				obj_tmp.address = obj.list[i].address;
				obj_tmp.id = obj.list[i].id
				obj_tmp.label = obj.list[i].name;
				obj_tmp.type = obj.list[i].type;
				obj_tmp.img_url = obj.list[i].image_url;
				arr = arr.concat(obj_tmp);
			}


				var autocomplete = $("#search_bar").kendoAutoComplete({
					minLength: 1,
					dataTextField: "name",
					template: '<span class="k-state-default" style="background-image: url(\'#:data.img_url#\')"></span>' +
							  '<span class="k-state-default"><h3>#: data.name #</h3><p>#: data.address #</p></span>',
					virtual: {
						itemHeight: 110
					},
					dataSource: arr,
					height: 440,
					select:function(e){
						var dataItem = this.dataItem(e.item.index());
						var obj=JSON.parse(kendo.stringify(dataItem));
						if(obj.type==0){
							store_list();
							view_store(obj.id,'store_map');
						}
						else{
							company_list();
							view_company(obj.id);
						}
					}
				}).data("kendoAutoComplete");
				$("#search_bar").on('focus',function(){
					autocomplete.search($("#search_bar").val());

				});
		  });
	});
});