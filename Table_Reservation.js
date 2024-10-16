// Add event listener to search icon
const searchIcon = document.getElementById('search-icon');
        const searchBar = document.getElementById('search-bar');

        searchIcon.addEventListener('click', () => {
            if (searchBar.style.display === 'inline-block') {
                searchBar.style.display = 'none';
            } else {
                searchBar.style.display = 'inline-block';
                searchBar.focus(); // Focus the input when it becomes visible
            }
        });