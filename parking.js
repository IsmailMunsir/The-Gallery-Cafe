// Sample parking lot data
const parkingLots = [
    { id: 1, name: 'Lot A', status: 'available' },
    { id: 2, name: 'Lot B', status: 'unavailable' },
    { id: 3, name: 'Lot C', status: 'available' },
];

// Function to display parking lot status
function displayParkingLots() {
    const parkingLotsContainer = document.getElementById('parking-lots');

    parkingLots.forEach(lot => {
        const lotDiv = document.createElement('div');
        lotDiv.className = `parking-lot ${lot.status}`;
        lotDiv.innerHTML = `<strong>${lot.name}</strong> is ${lot.status}`;
        parkingLotsContainer.appendChild(lotDiv);
    });
}

// Call the function to display the parking lots
displayParkingLots();
