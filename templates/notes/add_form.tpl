<div style="display:none" id="add_form_block" class="add_form_margin">
<div class="title_add_form">������� �������</div>
<div class="add_form add_form_margin">

<table cellpadding="0" cellspacing="0" class="tables_data_1">
    <tr>
    	<td class="td_title td_vert_top">����</td>
        <td class="td_value"><input id="note_theme" class="input_text" style="width:650px;"/>
        <div id="text_error" class="td_error sub_input_error"></div>
        </td>
    </tr>
    <tr>
    	<td class="td_title td_vert_top">�����</td>
        <td class="td_value"><textarea id="note_text" class="input_text" style="width:650px; height:100px"></textarea>
        <div id="text_error" class="td_error sub_input_error"></div>
        </td>
    </tr>
    <tr>
    	<td class="td_title"></td>
        <td class="td_value">
        <a class="button" onclick="add_note()" href="javascript:;" id="add_note_btn">
    <div class="right"></div><div class="left"></div><div class="btn_cont">�������</div></a></td>
        
    </tr> 
     
</table>

</div>

<div class="stand_margin">
<a href="javascript:;" class="link" onclick="$('#add_form_block').hide(); $('#show_add_form_a').show()">������</a>
</div>

</div>

<div class="add_new_list_item" id="show_add_form_a" > 
<a href="javascript:;" class="link" onclick="$('#add_form_block').fadeIn(200); $('#show_add_form_a').hide()">+ ������� �������</a>
</div>


<script>

planning_date_init(1, 0);
planning_date_init(2, 0);

</script>