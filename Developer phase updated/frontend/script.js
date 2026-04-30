async function submitIncident() {
    const userId = document.getElementById('userId').value;
    const incidentType = document.getElementById('incidentType').value;
    const description = document.getElementById('description').value;
    if (!userId || !incidentType || !description) {
        document.getElementById('message').textContent = 'Please fill all fields.';
        document.getElementById('message').className = 'error';
        return;
    }
    const response = await fetch('../api/reportIncident.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `user_id=${userId}&incident_type=${incidentType}&description=${description}`,
    });
    const result = await response.json();
    document.getElementById('message').textContent = result.message;
    document.getElementById('message').className = result.status === 'success' ? 'success' : 'error';
    if (result.status === 'success') {
        document.getElementById('userId').value = '';
        document.getElementById('incidentType').value = '';
        document.getElementById('description').value = '';
        fetchIncidents();
    }
}

async function fetchIncidents() {
    const response = await fetch('../api/getIncidents.php');
    const result = await response.json();
    const incidentsDiv = document.getElementById('incidents');
    incidentsDiv.innerHTML = result.incidents.map(inc => `
        <div class="incident">
            <p><strong>User:</strong> ${inc.user_id}</p>
            <p><strong>Type:</strong> ${inc.incident_type}</p>
            <p><strong>Status:</strong> ${inc.status}</p>
            <p><strong>Description:</strong> ${inc.description}</p>
        </div>
    `).join('');
}

fetchIncidents();
setInterval(fetchIncidents, 5000);
