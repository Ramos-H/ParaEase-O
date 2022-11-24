
function on_checkbox_click(event)
{
  event.stopPropagation();
}

function select_all(table_name)
{
  if (table_name === 'feedbacks' || table_name === 'package_inquiries')
  {
    var checkboxes = document.getElementById(table_name).getElementsByClassName("selector");
    for (var index = 0; index < checkboxes.length; index++)
    {
      checkboxes[index].checked = true;
    }
  }
}

function select_none(table_name)
{
  if (table_name === 'feedbacks' || table_name === 'package_inquiries')
  {
    var checkboxes = document.getElementById(table_name).getElementsByClassName("selector");
    for (var index = 0; index < checkboxes.length; index++)
    {
      checkboxes[index].checked = false;
    }
  }
}

function show_entry_full(entry, table_name)
{
  var entry_name_first = entry.getElementsByClassName("name_first")[0].innerText;
  var entry_name_last = entry.getElementsByClassName("name_last")[0].innerText;
  var entry_email = entry.getElementsByClassName("email")[0].innerText;
  var entry_subject = entry.getElementsByClassName("subject")[0].innerText;
  var entry_message = entry.getElementsByClassName("message")[0].innerText;
  var entry_status = entry.getElementsByClassName("current_status")[0].value;
  var entry_id = entry.getElementsByClassName("selector")[0].getAttribute("name").replace("statuses[", "").replace("]", "");
  
  var modal = document.getElementById('modal_entry');
  var modal_name_first = modal.getElementsByClassName("name_first")[0];
  var modal_name_last = modal.getElementsByClassName("name_last")[0];
  var modal_email = modal.getElementsByClassName("email")[0];
  var modal_subject = modal.getElementsByClassName("subject")[0];
  var modal_message = modal.getElementsByClassName("message")[0];
  var modal_status = modal.getElementsByClassName("status")[0];
  var modal_button_resolve = modal.getElementsByClassName("resolve")[0];
  var modal_button_unresolve = modal.getElementsByClassName("unresolve")[0];
  var modal_table_value_container = modal.getElementsByClassName("table_name")[0];
  var modal_package = modal.getElementsByClassName("package")[0];
  var modal_package_container = modal.getElementsByClassName("package_container")[0];

  modal_name_first.innerText = entry_name_first;
  modal_name_last.innerText = entry_name_last;
  modal_email.innerText = entry_email;
  modal_subject.innerText = entry_subject;
  modal_message.innerText = entry_message;
  if (entry_status == "1")
  {
    modal_status.innerText = "RESOLVED";
  }
  else if (entry_status == "0")
  {
    modal_status.innerText = "UNRESOLVED";
  }
  else
  {
    modal_status.innerText = "UNKNOWN";
  }

  modal_button_resolve.value = `single_resolve_${entry_id}`;
  modal_button_unresolve.value = `single_unresolve_${entry_id}`;
  
  var packages = ['A', 'B', 'C'];
  
  if (table_name === 'feedbacks')
  {
    modal_table_value_container.value = 'feedbacks';
    modal_package_container.style.display = 'none';

    
    modal_button_resolve.setAttribute('form', 'form_feedbacks');
    modal_button_unresolve.setAttribute('form', 'form_feedbacks');
    modal_table_value_container.setAttribute('form', 'form_feedbacks');
  }
  else if (table_name === 'package_inquiries')
  {
    var entry_package_id = entry.getElementsByClassName("package_id")[0].value;
    modal_table_value_container.value = 'package_inquiries';
    
    var package_letter = packages[Math.min(Math.max(entry_package_id - 1, 0), 2)];
    modal_package.innerText = `PACKAGE ${package_letter}`;
    modal_package_container.style.display = 'inherit';
    
    modal_button_resolve.setAttribute('form', 'form_package_inquiries');
    modal_button_unresolve.setAttribute('form', 'form_package_inquiries');
    modal_table_value_container.setAttribute('form', 'form_package_inquiries');
  }
  else
  {
    modal_table_value_container.value = '';
  }

  var modal_object = new bootstrap.Modal(modal);
  modal_object.show();
}