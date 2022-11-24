const MAX_FIELD_CHARS = 30;
const MAX_MESSAGE_CHARS = 10000;

function check_input_field_validity(field, property_name, max_chars)
{
  if (field !== null)
  {
    var value_length = field.value.trim().length;
    var error_container = field.parentElement.getElementsByClassName("invalid-feedback")[0];
    if (value_length < 1)
    {
      error_container.innerText = `Please enter your ${property_name}.`;
      field.classList.add("is-invalid");
    }
    else if (value_length > max_chars)
    {
      error_container.innerText = `You can enter only up to ${max_chars.toLocaleString()} characters. Please delete ${(value_length - 30).toLocaleString()} characters to continue.`;
      field.classList.add("is-invalid");
    }
    else
    {
      field.classList.remove("is-invalid");
    }
  }
}

function check_field_validity(field, property_name)
{
  check_input_field_validity(field, property_name, MAX_FIELD_CHARS);
}

function check_text_area_validity(text_area, property_name)
{
  check_input_field_validity(text_area, property_name, MAX_MESSAGE_CHARS);
}

function check_field_empty(field, property_name)
{
  if (field !== null)
  {
    var value_length = field.value.trim().length;
    var error_container = field.parentElement.getElementsByClassName("invalid-feedback")[0];
    if (value_length < 1)
    {
      error_container.innerText = `Please enter your ${property_name}.`;
      field.classList.add("is-invalid");
    }
    else
    {
      field.classList.remove("is-invalid");
    }
  }
}


function form_submit(form)
{
  var fields = form.getElementsByClassName("form-control");

  var bad_form = false;
  for (let index = 0; index < fields.length; index++)
  {
    const field = fields[index];
    var value_length = field.value.trim().length;
    if (value_length > 0)
    {
      var attribute_name = field.getAttribute("name");
      if (attribute_name !== 'message')
      {
        if (value_length > MAX_FIELD_CHARS) { bad_form = true; break; }
      }
      else
      {
        if (value_length > MAX_MESSAGE_CHARS) { bad_form = true; break; }
      }
    }
    else
    {
      bad_form = true;
      break;
    }
  }

  if (bad_form)
  {
    alert("Please accomplish the form properly before submitting.");
    return false;
  }

  return true;
}