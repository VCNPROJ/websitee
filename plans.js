const API_BASE = "/api";

async function loadPlans(type) {
  const res = await fetch(`${API_BASE}/plans.php`);
  const data = await res.json();
  const box = document.getElementById("plansContainer");
  box.innerHTML = "";

  data[type].forEach(plan => {
    const popular = plan.popular ? "popular" : "";
    const badge = plan.popular ? `<div class="popular-badge">POPULAR</div>` : "";

    box.innerHTML += `
      <div class="col-md-4">
        <div class="plan-card ${popular}">
          ${badge}
          <h5>${plan.speed || plan.name}</h5>
          <div>${plan.data || plan.channels || plan.type}</div>

          <div class="plan-price" data-price="${plan.price}">₹0</div>

          <button class="btn btn-primary subscribe-btn"
            onclick="selectPlan('${plan.speed || plan.name}', ${plan.price})">
            Subscribe Now
          </button>
        </div>
      </div>
    `;
  });

  animatePrices();
}

// PRICE ANIMATION
function animatePrices() {
  document.querySelectorAll(".plan-price").forEach(el => {
    let target = +el.dataset.price;
    let current = 0;
    let interval = setInterval(() => {
      current += Math.ceil(target / 20);
      if (current >= target) {
        el.innerText = "₹" + target;
        clearInterval(interval);
      } else {
        el.innerText = "₹" + current;
      }
    }, 30);
  });
}

// SELECT PLAN
function selectPlan(plan, price) {
  localStorage.setItem("selectedPlan", plan);
  localStorage.setItem("selectedAmount", price);

  if (!localStorage.getItem("loggedIn")) {
    showLogin(); // your existing modal
    return;
  }

  location.href = "dashboard.html";
}

// DEFAULT LOAD
loadPlans("internet");
