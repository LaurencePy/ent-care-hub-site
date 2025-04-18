function fillFilters() {
    fetch('filters-db-fetch.php')
    .then(res => {
      if (res.ok) {
        return res.json();
      } else {
        throw new Error("Fetch failed");
      }
    })
    .then(response => {
      console.log("JSON Response:", response);

      const resultSpecialities = response.resultSpecialities;
      if (Array.isArray(resultSpecialities) && resultSpecialities.length > 0) {
        const specialitySelect = document.getElementById("speciality-select");
        specialitySelect.innerHTML = '<option selected>Speciality</option>';
        resultSpecialities.forEach(item => {
          const option = document.createElement("option");
          option.value = item;
          option.textContent = item;
          specialitySelect.appendChild(option);
        });
      } else {
        console.error("No specialities available to populate.");
      }

      const resultClinics = response.resultClinics;
      if (Array.isArray(resultClinics) && resultClinics.length > 0) {
        const clinicSelect = document.getElementById("clinic-select");
        clinicSelect.innerHTML = '<option selected>Clinic</option>';
        resultClinics.forEach(item => {
          const option = document.createElement("option");
          option.value = item;
          option.textContent = item;
          clinicSelect.appendChild(option);
        });
      } else {
        console.error("No clinics available to populate.");
      }
    })
    .catch(error => {
      document.getElementById("error-message").innerText = "Error: " + error.message;
    });
}

document.getElementById('consultant-search-button').addEventListener('click', function (e) {
  e.preventDefault();

  const speciality = document.getElementById("speciality-select").value;
  const clinic = document.getElementById("clinic-select").value;
  const avgScore = document.getElementById("avg-score-select").value;
  const fee = document.getElementById("fee-slider-select").value;
  const date = document.getElementById("date").value;

  const queryParams = new URLSearchParams({
    speciality,
    clinic,
    score: avgScore,
    fee: fee,
    date
  });

  window.location.href = `search-results.php?${queryParams.toString()}`;
});




document.addEventListener('DOMContentLoaded', function() {
    fillFilters();
  });