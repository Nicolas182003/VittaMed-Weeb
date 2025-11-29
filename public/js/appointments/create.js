let $doctor, $date, $specialty, iRadio;
let $hoursMorning, $hoursAfternoon;

const morningCardHTML = (content) => `
<div class="card border-0 mb-3" style="background: linear-gradient(135deg, #4F46E5 0%, #6366F1 100%);">
    <div class="card-body p-3">
        <h5 class="text-white mb-3">
            <i class="fas fa-sun mr-2"></i>Horario Matutino
        </h5>
        ${content}
    </div>
</div>`;

const afternoonCardHTML = (content) => `
<div class="card border-0 mb-3" style="background: linear-gradient(135deg, #10B981 0%, #059669 100%);">
    <div class="card-body p-3">
        <h5 class="text-white mb-3">
            <i class="fas fa-moon mr-2"></i>Horario Vespertino
        </h5>
        ${content}
    </div>
</div>`;

const noHoursMessage = `<div class="alert alert-warning" role="alert">
    <i class="fas fa-exclamation-circle mr-2"></i>
    <strong>No hay horarios disponibles</strong> para este día.
</div>`;

$(function(){
    $specialty = $('#specialty');
    $doctor = $('#doctor');
    $date = $('#date');
    $hoursMorning = $('#hoursMorning');
    $hoursAfternoon = $('#hoursAfternoon');

    $specialty.change(() => {
        const specialtyId = $specialty.val();
        const url = `/api/especialidades/${specialtyId}/medicos`;
        $.getJSON(url, onDoctorsLoaded);
    });

    $doctor.change(loadHours);
    $date.change(loadHours);
});

function onDoctorsLoaded (doctors) {
    let htmlOptions = '';
    doctors.forEach(doctor => {
        htmlOptions += `<option value="${doctor.id}" >${doctor.name}</option>`;
    });
    $doctor.html(htmlOptions);

    loadHours();
}

function loadHours() {
    const selectedDate = $date.val();
    const doctorId = $doctor.val();
    const url = `/api/horario/horas?date=${selectedDate}&doctor_id=${doctorId}`;
    $.getJSON(url, displayHours);
}

function displayHours(data){
    let htmlHoursM = '';
    let htmlHoursA = '';
    let radioContent = '';
    let hasAnySchedule = false;

    iRadio = 0;

    // Procesar horarios de la mañana
    if(data.morning && data.morning.length > 0){
        const morning_intervalos = data.morning;
        radioContent = '';
        morning_intervalos.forEach(intervalo => {
            radioContent += getRadioIntervaloHTML(intervalo, 'text-white');
        });
        htmlHoursM = morningCardHTML(radioContent);
        hasAnySchedule = true;
    }

    // Procesar horarios de la tarde
    if(data.afternoon && data.afternoon.length > 0){
        const afternoon_intervalos = data.afternoon;
        radioContent = '';
        afternoon_intervalos.forEach(intervalo => {
            radioContent += getRadioIntervaloHTML(intervalo, 'text-white');
        });
        htmlHoursA = afternoonCardHTML(radioContent);
        hasAnySchedule = true;
    }

    // Si no hay horarios en ningún turno, mostrar mensaje
    if(!hasAnySchedule){
        htmlHoursM = noHoursMessage;
    }

    // Actualizar el DOM
    $hoursMorning.html(htmlHoursM);
    $hoursAfternoon.html(htmlHoursA);
}

function getRadioIntervaloHTML(intervalo, textClass = ''){
    const text = `${intervalo.start} - ${intervalo.end}`;

    return `<div class="custom-control custom-radio mb-2">
            <input type="radio" id="interval${iRadio}" name="scheduled_time" value="${intervalo.start}" class="custom-control-input" required>
            <label class="custom-control-label ${textClass}" for="interval${iRadio++}">
                <i class="far fa-clock mr-1"></i>${text}
            </label>
            </div>`;
}