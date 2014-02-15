@section('content')
<div id="grid"></div>
@stop

@section('script')
<script src="/js/kendoui/2013.3.1119/cultures/kendo.culture.tr-TR.min.js"></script>
<script>
kendo.culture('tr-TR');
var dataSource = new kendo.data.DataSource({
	transport: {
		read: {
			dataType : "json",
			url      : "/panel/api/payments/list",
			type     : "get"
		},
		update: {
			dataType : "json",
			url      : "/panel/api/payments/update",
			type     : "post",
			headers  : {'X-CSRF-Token': '{{ Session::token() }}'}
		},
		destroy: {
			dataType : "json",
			url      : "/panel/api/payments/destroy",
			type     : "post",
			headers  : {'X-CSRF-Token': '{{ Session::token() }}'}
		},
		create: {
			dataType : "json",
			url      : "/panel/api/payments/create",
			type     : "post",
			headers  : {'X-CSRF-Token': '{{ Session::token() }}'}
		},
		parameterMap: function(options, operation) {
			if (operation !== "read" && options.models) {
				return {models: kendo.stringify(options.models)};
			}
		}
	},
	batch: true,
	pageSize: 10,
	schema: {
		model: {
			id: "id",
			fields: {
				id      : { editable: false, nullable: false },
				fullname: { type: "string", validation: { required: true } },
				amount  : { type: "number", validation: { required: true }, format: "{0:c2}" },
				date    : { type: "date"  , validation: { required: true }, format: "{0:yyyy-MM-dd}" },
				type    : { type: "string", validation: { required: true } },
				description: { type: "string" }
			}
		}
	}
});

$("#grid").kendoGrid({
	dataSource: dataSource,
	pageable: { pageSize: 10, pageSizes: [5, 10, 20, 30], refresh: true },
	sortable: { mode: "multiple" },
	resizable: true,
	filterable: true,
	selectable: true,
	// groupable: true,
	columnResizeHandleWidth: 8,
	// height: 430,
	editable: "popup",
	toolbar: ["create"],
	detailTemplate: "<div>#: fullname #</div>",
	columns: [
		{ field: "fullname"  , title:"User" , width: "200px", editor: user_template },
		{ field: "amount", title:"Amount", width: "150px", format: "{0:c2}" },
		{ field: "date"  , title: "Date" , width: "120px", editor: date_template, format: "{0:MMMM, yyyy}" },
		{ field: "type" , title:"Type"  , width: "150px", editor: payment_types },
		{ field: "description", title:"Description"},
		{ command: ["edit", "destroy"], title: "&nbsp;", width: "180px", attributes: { style: "text-align: center;" } }
	]
});

function payment_types(container, options) {
	$('<input required name="type" >')
		.appendTo(container)
		.kendoComboBox({
			dataTextField: "value",
			dataValueField: "value",
			// autoBind: false,
			// filter: "contains",
			// suggest: true,
			// index: 0,
			dataSource: {
				transport: {
					read: {
						dataType : "json",
						url      : "/panel/api/payment/types/list",
						type     : "get"
					}
				}
			}
		});
}

function date_template(container, options) {
	$('<input name="date" required>')
	.appendTo(container)
	.kendoDatePicker({
		// defines the start view
		start: "year",

		// defines when the calendar should return date
		depth: "year",

		// display month
		format: "MMMM, yyyy",
		defaultValue: new Date()
	})
}

function user_template(container, options) {
	$('<input name="user" required>')
	.appendTo(container)
	.kendoComboBox({
		dataTextField: "fullname",
		dataValueField: "id",
		autoBind: true,
		filter: "contains",
		suggest: true,
		dataSource: {
			transport: {
				read: {
					dataType : "json",
					url      : "/panel/api/user/list",
					type     : "get"
				}
			}
		}
	});
}
</script>
@stop