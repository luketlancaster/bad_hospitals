var states = {"AL":"Alabama","AK":"Alaska","AZ":"Arizona","AR":"Arkansas","CA":"California","CO":"Colorado","CT":"Connecticut","DE":"Delaware","DC":"District Of Columbia","FL":"Florida","GA":"Georgia","HI":"Hawaii","ID":"Idaho","IL":"Illinois","IN":"Indiana","IA":"Iowa","KS":"Kansas","KY":"Kentucky","LA":"Louisiana","ME":"Maine","MD":"Maryland","MA":"Massachusetts","MI":"Michigan","MN":"Minnesota","MS":"Mississippi","MO":"Missouri","MT":"Montana","NE":"Nebraska","NV":"Nevada","NH":"New Hampshire","NJ":"New Jersey","NM":"New Mexico","NY":"New York","NC":"North Carolina","ND":"North Dakota","OH":"Ohio","OK":"Oklahoma","OR":"Oregon","PA":"Pennsylvania","PR":"Puerto Rico","RI":"Rhode Island","SC":"South Carolina","SD":"South Dakota","TN":"Tennessee","TX":"Texas","UT":"Utah","VT":"Vermont","VA":"Virginia","WA":"Washington","WV":"West Virginia","WI":"Wisconsin","WY":"Wyoming"}



$(document).ready(function() {
  var stateSelect = $('#stateSelect');
  var button = $('#getData');

  for (key in states) {
    var option = '<option value='+key+'>'+states[key]+'</option>';
    stateSelect.append(option);
  }

  button.click(getHospitalNames);

  function getHospitalNames(event) {
    event.preventDefault();

    var state = stateSelect.val();

    $.ajax({
      type: "POST",
      url: "index.php",
      data: {state: state},
      success: attachHospitals
    });
  }

  function attachHospitals(hospitals) {
    var hospitals = $.parseJSON(hospitals);
    var hospitalDiv = $("#hospitals");
    var hospitalCountDiv = $("#hospitalCount");

    hospitalDiv.html('');
    hospitalCountDiv.html('<h2>There are ' + hospitals.length + ' Scary Hospitals in ' + stateSelect.val() +'<h2>');
    hospitals.forEach(function(hospital) {
      hospitalDiv.append(createTemplate(hospital));
    });
  }

  function createTemplate(hospital) {
    var html = "<div class='twelve columns hospital_box'>";
        html += "<h3>" + hospital.hospital_name + "</h3>";
        html += "<p>" + hospital.address + ", " + hospital.city + ", ";
        html += hospital.state + " " + hospital.zip_code + "</p>";
    
    return html;
  }

});
