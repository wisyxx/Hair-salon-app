let step = 1;
const initialStep = 1;
const lastStep = 3;

const apointment = {
  name: '',
  date: '',
  hour: '',
  services: [],
};

document.addEventListener('DOMContentLoaded', () => {
  startApp();
});

function startApp() {
  showSection();
  paginationButtons();
  tabs(); // Change section when pressing on one of the tabs
  previousSection();
  nextSection();

  queryAPI();
  clientName(); // Sets the client name to the apointment obj
  apointmentDate(); // Sets the apointment date to the apointment obj
  apointmentHour(); // Sets the apointment hour to the apointment obj

  showSummary();
}

function showSection() {
  // Hide
  const previousSection = document.querySelector('.show');
  if (previousSection) {
    previousSection.classList.remove('show');
  }

  // Show
  const stepSelector = `#step-${step}`;
  const section = document.querySelector(stepSelector);
  section.classList.add('show');

  // Deletes the highlighting from the tab
  const previousTab = document.querySelector('.current');
  if (previousTab) {
    previousTab.classList.remove('current');
  }

  // Highlights the current tab
  const tabSelector = `[data-step="${step}"]`;
  const tab = document.querySelector(tabSelector);
  tab.classList.add('current');
}

function tabs() {
  const buttons = document.querySelectorAll('.tabs button');

  buttons.forEach((button) => {
    button.addEventListener('click', (e) => {
      step = parseInt(e.target.dataset.step);
      showSection();
      paginationButtons();
    });
  });
}

function paginationButtons() {
  const nextButton = document.querySelector('#next');
  const previousButton = document.querySelector('#previous');

  switch (step) {
    case 1:
      previousButton.classList.add('hide');
      nextButton.classList.remove('hide');
      break;
    case 3:
      nextButton.classList.add('hide');
      previousButton.classList.remove('hide');
      showSummary();
      break;
    default:
      nextButton.classList.remove('hide');
      previousButton.classList.remove('hide');
      break;
  }

  nextButton.addEventListener('click', () => {});
  previousButton.addEventListener('click', () => {});
}

function previousSection() {
  const previousButton = document.querySelector('#previous');
  previousButton.addEventListener('click', () => {
    if (step <= initialStep) return;
    step--;

    paginationButtons();
    showSection();
  });
}

function nextSection() {
  const nextButton = document.querySelector('#next');
  nextButton.addEventListener('click', () => {
    if (step >= lastStep) return;
    step++;

    paginationButtons();
    showSection();
  });
}

async function queryAPI() {
  try {
    const url = 'http://localhost:3000/api/services';
    const result = await fetch(url);
    const services = await result.json();
    showServices(services);
  } catch (error) {
    console.log(error);
  }
}

function showServices(services) {
  services.forEach((service) => {
    const { id, name, price } = service;

    const serviceName = document.createElement('P');
    serviceName.classList.add('service-name');
    serviceName.textContent = name;

    const servicePrice = document.createElement('P');
    servicePrice.classList.add('service-price');
    servicePrice.textContent = `${price}€`;

    const serviceDiv = document.createElement('DIV');
    serviceDiv.classList.add('service');
    serviceDiv.dataset.serviceId = id;
    serviceDiv.onclick = function () {
      selectService(service);
    };

    serviceDiv.appendChild(serviceName);
    serviceDiv.appendChild(servicePrice);

    document.querySelector('#services').appendChild(serviceDiv);
  });
}

function selectService(service) {
  const { id } = service;
  const { services } = apointment;

  const serviceDiv = document.querySelector(`[data-service-id="${id}"]`);

  if (services.some((selected) => selected.id === service.id)) {
    apointment.services = services.filter((selected) => selected.id !== id);
    serviceDiv.classList.remove('selected');
  } else {
    apointment.services = [...services, service]; // Same as apointment.services.push(service)
    serviceDiv.classList.add('selected');
  }
}

function clientName() {
  apointment.name = document.querySelector('#name').value;
}
function apointmentDate() {
  const dateInput = document.querySelector('#date');

  dateInput.addEventListener('input', (e) => {
    const day = new Date(e.target.value).getUTCDay();

    if ([0].includes(day)) {
      e.target.value = '';
      showAlert("You can't select Sundays", 'error', 'form');
    } else {
      apointment.date = e.target.value;
    }
  });
}

function apointmentHour() {
  const hourInput = document.querySelector('#hour');

  hourInput.addEventListener('input', (e) => {
    const hour = e.target.value.split(':')[0];
    if (hour < 10 || hour > 20) {
      showAlert('The hour must be between 10:00 and 20:00', 'error', 'form');
    } else {
      apointment.hour = e.target.value;
    }
  });
}

function showAlert(message, alertType, page, disapears = true) {
  const previousAlert = document.querySelector('.error');
  if (previousAlert) previousAlert.remove();

  const alert = document.createElement('DIV');
  const displayPage = document.querySelector(`.${page}`);

  alert.textContent = message;
  alert.classList.add(alertType);
  displayPage.appendChild(alert);

  if (disapears) {
    setTimeout(() => {
      alert.remove();
    }, 3000);
  }
}

function showSummary() {
  const summary = document.querySelector('.summary-content');

  // Clean the summary page
  while (summary.firstChild) {
    summary.removeChild(summary.firstChild);
  }

  if (
    Object.values(apointment).includes('') ||
    apointment.services.length === 0
  ) {
    showAlert(
      'Some values are missing or no services have been selected, please review your apointment',
      'error',
      'summary-content',
      false
    );

    return;
  }

  const { name, date, hour, services } = apointment;

  // Show services
  const servicesHeading = document.createElement('H3');
  servicesHeading.textContent = 'Services summary';
  summary.appendChild(servicesHeading);

  services.forEach((service) => {
    const { price, name } = service;

    const serviceContainer = document.createElement('DIV');
    serviceContainer.classList.add('service-container');

    const serviceName = document.createElement('P');
    serviceName.textContent = name;

    const servicePrice = document.createElement('P');
    servicePrice.innerHTML = `<span>Price: </span>$${price}`;

    serviceContainer.append(serviceName, servicePrice);

    summary.appendChild(serviceContainer);
  });

  // Format apointment data
  const dateObj = new Date(date);
  const month = dateObj.getMonth();
  const day = dateObj.getDate() + 2;
  const year = dateObj.getFullYear();
  
  const UTCDate = new Date( Date.UTC(year, month, day));
  const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
  const formatedDate = UTCDate.toLocaleDateString('en-US', options);

  // Show apointment data
  const apointmentDataHeading = document.createElement('H3');
  apointmentDataHeading.textContent = 'Apointment summary';
  summary.appendChild(apointmentDataHeading);

  const clientName = document.createElement('P');
  clientName.innerHTML = `<span>Name: </span>${name}`;

  const apointmentDate = document.createElement('P');
  apointmentDate.innerHTML = `<span>Date: </span>${formatedDate}`;

  const apointmentHour = document.createElement('P');
  apointmentHour.innerHTML = `<span>Hour: </span>${hour}`;

  // Create apointment button
  const bookingButton = document.createElement('BUTTON');
  bookingButton.classList.add('button');
  bookingButton.textContent = 'Book apointment';
  bookingButton.onclick = bookApointment;

  summary.append(clientName, apointmentDate, apointmentHour, bookingButton);
}

function bookApointment() {
  
}