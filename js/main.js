
window.onload = function() {
    const greetingElement = document.getElementById("greeting-message");
    if (greetingElement) {
        const hour = new Date().getHours();
        let greeting;
        
        
        if (hour < 12) {
            greeting = "Good morning! Ready for some early-bird matchmaking?";
        } else if (hour < 18) {
            greeting = "Good afternoon! The campus servers are live.";
        } else {
            greeting = "Good evening! Prime time for ranked grinding.";
        }
        
        greetingElement.innerText = greeting;
    }

    // Load all events initially if on the events page
    if (document.getElementById("events-container")) {
        displayEvents(eventsArray);
    }
};


const eventsArray = [
    {
        title: "Call of Duty Mobile: Campus Open",
        date: "October 15, 2026",
        game: "Call of Duty Mobile",
        description: "Squad up for our monthly CODM Search & Destroy tournament."
    },
    {
        title: "Cuphead Co-Op Speedrun Challenge",
        date: "October 22, 2026",
        game: "Cuphead",
        description: "Grab a partner and see who can clear Inkwell Isle One the fastest."
    },
    {
        title: "Fall Semester LAN Party",
        date: "November 5, 2026",
        game: "General",
        description: "Bring your own rig. Casual play, pizza, and open lobbies all night."
    }
];


// Function to display events in the HTML container
function displayEvents(eventsToShow) {
    const container = document.getElementById("events-container");
    container.innerHTML = "";
    
    
    if (eventsToShow.length === 0) {
        container.innerHTML = "<p>No events found for this category.</p>";
        return;
    }

    
    eventsToShow.forEach(event => {
        const eventHTML = `
            <div class="event-card" style="border: 1px solid #ddd; padding: 15px; margin-bottom: 10px; border-radius: 5px;">
                <h3>${event.title}</h3>
                <p><strong>Date:</strong> ${event.date} | <strong>Game:</strong> ${event.game}</p>
                <p>${event.description}</p>
            </div>
        `;
        container.innerHTML += eventHTML;
    });
}

// Function triggered by the onclick event handlers on the filter buttons
function filterEvents(gameCategory) {
    if (gameCategory === "All") {
        displayEvents(eventsArray);
    } else {
        // Filter the events based on the selected game category
        const filteredEvents = eventsArray.filter(event => event.game === gameCategory);
        displayEvents(filteredEvents);
    }
}


function validateJoinForm() {
    const name = document.forms["joinForm"]["student_name"].value;
    const studentId = document.forms["joinForm"]["student_id"].value;
    const game = document.forms["joinForm"]["primary_game"].value;

    if (name === "" || studentId === "" || game === "") {
        alert("Please fill out all required fields before submitting.");
        return false; // Prevents form submission
    }
    
    // Basic length check for a student ID
    if (studentId.length < 5) {
        alert("Please enter a valid HIT Student ID.");
        return false;
    }
    
    return true; // Allows form submission if all checks pass
}