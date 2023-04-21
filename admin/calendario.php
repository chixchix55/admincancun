<?php 
$menu = 3;
include 'templates/header.php' ?>
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Modals -->
            <div class="modal fade" id="largeModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel3">Reservas</h5>
                      <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                      ></button>
                    </div>
                    <div class="modal-body">
                        <!-- <h1>Hola papi bello eres muy bueno la puta madre</h1> -->
                    </div>
                  </div>
                </div>
            </div>
            <div class="my-wrapper">
                <div class="calendar">
                    <div class="calendar-header">
                        <span class="month-picker" id="month-picker">April</span>
                        <div class="year-picker">
                            <span class="year-change" id="prev-year">
                                <pre><</pre>
                            </span>
                            <span id="year">2022</span>
                            <span class="year-change" id="next-year">
                                <pre>></pre>
                            </span>
                        </div>
                    </div>
                    <div class="calendar-body">
                        <div class="calendar-week-day">
                            <div>Dom</div>
                            <div>Lun</div>
                            <div>Mar</div>
                            <div>Mie</div>
                            <div>Jue</div>
                            <div>Vie</div>
                            <div>Sab</div>
                        </div>
                        <div class="calendar-days"></div>
                    </div>
                   
                    <div class="month-list"></div>
                </div>
                <script>
                    let calendar = document.querySelector('.calendar')

                    if (calendar != null){
                    const month_names = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre']

                    isLeapYear = (year) => {
                        return (year % 4 === 0 && year % 100 !== 0 && year % 400 !== 0) || (year % 100 === 0 && year % 400 ===0)
                    }

                    getFebDays = (year) => {
                        return isLeapYear(year) ? 29 : 28
                    }

                    generateCalendar = (month, year) => {

                        let calendar_days = calendar.querySelector('.calendar-days')
                        let calendar_header_year = calendar.querySelector('#year')

                        let days_of_month = [31, getFebDays(year), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31]

                        calendar_days.innerHTML = ''

                        let currDate = new Date()
                        if (month > 11 || month < 0) month = currDate.getMonth()
                        if (!year) year = currDate.getFullYear()

                        let curr_month = `${month_names[month]}`
                        month_picker.innerHTML = curr_month
                        calendar_header_year.innerHTML = year

                        // get first day of month
                        
                        let first_day = new Date(year, month, 1)

                        for (let i = 0; i <= days_of_month[month] + first_day.getDay() - 1; i++) {
                            let day = document.createElement('div')
                            if (i >= first_day.getDay()) {
                                day.classList.add('calendar-day-hover')
                                day.setAttribute('data-bs-toggle', 'modal')
                                day.setAttribute('data-bs-target', '#largeModal')
                                day.setAttribute('data-whatever', `${i - first_day.getDay() + 1}-${month+1}-${year}`)
                                day.innerHTML = i - first_day.getDay() + 1
                                day.innerHTML += `<span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>`
                                if (i - first_day.getDay() + 1 === currDate.getDate() && year === currDate.getFullYear() && month === currDate.getMonth()) {
                                    day.classList.add('curr-date')
                                }
                            }
                            calendar_days.appendChild(day)
                        }
                    }

                    let month_list = calendar.querySelector('.month-list');
                    /* Delete the last 12 entries in month_names */
                    month_names.forEach((e, index) => {  
                    let month = document.createElement('div')
                        month.innerHTML = `<div data-month="${index}">${e}</div>`
                        month.querySelector('div').onclick = () => {
                            month_list.classList.remove('show')
                            curr_month.value = index
                            generateCalendar(index, curr_year.value)
                        }
                        month_list.appendChild(month)
                    })

                    let month_picker = calendar.querySelector('#month-picker')

                    month_picker.onclick = () => {
                        month_list.classList.add('show')
                    }

                    let currDate = new Date()

                    let curr_month = {value: currDate.getMonth()}
                    let curr_year = {value: currDate.getFullYear()}

                    generateCalendar(curr_month.value, curr_year.value)

                    document.querySelector('#prev-year').onclick = () => {
                        --curr_year.value
                        generateCalendar(curr_month.value, curr_year.value)
                    }

                    document.querySelector('#next-year').onclick = () => {
                        ++curr_year.value
                        generateCalendar(curr_month.value, curr_year.value)
                    }
                    }
                </script>
                <script>
                    // Get the modal element
                    const modal = document.getElementById('largeModal');

                    // Get the modal title and body elements
                    const modalTitle = modal.querySelector('.modal-title');
                    const modalBody = modal.querySelector('.modal-body');

                    // Get all the buttons that toggle the modal

                    // Add click event listener to all calendar day hover elements
                    const calendarDayHovers = document.querySelectorAll(".calendar-day-hover");
                    calendarDayHovers.forEach((day) => {
                    day.addEventListener("click", () => {
                        const selectedDates = [];
                        const date = day.getAttribute("data-whatever");

                        // Add the selected date to the array of selected dates
                        selectedDates.push(date);

                        // Clear the modal body
                        modalBody.innerHTML = "";
                        // reemplazar este for cochino con un php que traiga la informacion correcta segun la fecha que viene desde data-whatever
                        selectedDates.forEach((date) => {
                        const h1 = document.createElement("h5");
                        h1.textContent = "Reservas para la fecha: "+date;
                        modalBody.appendChild(h1);
                        const table = document.createElement("table");
                        table.classList.add("table");
                        table.classList.add("table-striped");
                        table.classList.add("table-bordered");
                        table.classList.add("table-hover");
                        table.classList.add("table-sm");
                        table.classList.add("table-responsive");
                        
                        const thead = document.createElement("thead");
                        const tr = document.createElement("tr");
                        const th = document.createElement("th");
                        th.setAttribute("scope", "col");
                        th.textContent = "Fecha Ida";
                        tr.appendChild(th);
                        const th2 = document.createElement("th");
                        th2.setAttribute("scope", "col");
                        th2.textContent = "Cliente";
                        tr.appendChild(th2);
                        const th3 = document.createElement("th");
                        th3.setAttribute("scope", "col");
                        th3.textContent = "Precio";
                        tr.appendChild(th3);
                        const th4 = document.createElement("th");
                        th4.setAttribute("scope", "col");
                        th4.textContent = "Paquete";
                        tr.appendChild(th4);
                        const th5 = document.createElement("th");
                        th5.setAttribute("scope", "col");
                        th5.textContent = "Precio";
                        const th6 = document.createElement("th");
                        th6.setAttribute("scope", "col");
                        th6.textContent = "Estado";
                        tr.appendChild(th6);
                        tr.appendChild(th5);
                        thead.appendChild(tr);
                        table.appendChild(thead);
                        //Juan Pérez	Ciudad de México	Cancún	Todo incluido	Paquete 1	04/01/2023	04/05/2023	8000	Activa
                        const tbody = document.createElement("tbody");
                        const tr2 = document.createElement("tr");
                        const td = document.createElement("td");
                        td.textContent = "04/01/2023";
                        tr2.appendChild(td);
                        const td2 = document.createElement("td");
                        td2.textContent = "Juan Pérez";
                        tr2.appendChild(td2);
                        const td3 = document.createElement("td");
                        td3.textContent = "8000";
                        tr2.appendChild(td3);
                        const td4 = document.createElement("td");
                        td4.textContent = "Paquete 1";
                        tr2.appendChild(td4);
                        const td5 = document.createElement("td");
                        td5.textContent = "8000";
                        tr2.appendChild(td5);
                        const td6 = document.createElement("td");
                        const span = document.createElement("span");
                        //badge bg-label-primary me-1
                        span.classList.add("badge");
                        span.classList.add("bg-label-primary");
                        span.classList.add("me-1");
                        span.textContent = "Activa";
                        td6.appendChild(span);
                        tr2.appendChild(td6);
                        tbody.appendChild(tr2);
                        table.appendChild(tbody);
                        modalBody.appendChild(table);
                        });
                    });
                    });
                </script>
            </div>

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->
    <?php include 'templates/footer.php' ?>
