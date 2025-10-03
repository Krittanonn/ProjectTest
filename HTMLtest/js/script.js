
  let autoPlayInterval = null;
        let currentIndex = 0;
        let currentColumns = 4;

        // Set Columns
        function setColumns(cols) {
            currentColumns = cols;
            const temple = document.getElementById('temple');
            temple.className = 'templeall cols-' + cols;
            
            // Update button states
            document.getElementById('col2').classList.remove('active');
            document.getElementById('col3').classList.remove('active');
            document.getElementById('col4').classList.remove('active');
            document.getElementById('col' + cols).classList.add('active');
        }

        // Toggle Auto Play
        function toggleAutoPlay() {
            const btn = document.getElementById('autoPlayBtn');
            
            if (autoPlayInterval) {
                // Stop auto play
                clearInterval(autoPlayInterval);
                autoPlayInterval = null;
                btn.textContent = 'เปิด';
                btn.classList.remove('active');
            } else {
                // Start auto play
                autoPlayInterval = setInterval(rotateItems, 2000);
                btn.textContent = 'ปิด';
                btn.classList.add('active');
            }
        }

        // Rotate items
        function rotateItems() {
            const temple = document.getElementById('temple');
            const items = temple.children;
            
            if (items.length > 0) {
                // Move first item to end
                temple.appendChild(items[0]);
            }
        }

        // Initialize
        setColumns(4);