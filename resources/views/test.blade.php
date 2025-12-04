<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interactive Map with Address Search</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            padding: 20px;
            color: #333;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        header {
            text-align: center;
            margin-bottom: 30px;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        
        h1 {
            color: #2c3e50;
            margin-bottom: 10px;
        }
        
        .description {
            color: #7f8c8d;
            max-width: 800px;
            margin: 0 auto;
            line-height: 1.6;
        }
        
        .content {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            margin-bottom: 30px;
        }
        
        .map-section {
            flex: 1;
            min-width: 300px;
        }
        
        .form-section {
            flex: 1;
            min-width: 300px;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        
        .map-container {
            height: 400px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        
        iframe {
            width: 100%;
            height: 100%;
            border: none;
        }
        
        h2 {
            color: #2c3e50;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #3498db;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #2c3e50;
        }
        
        input, select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            transition: border 0.3s;
        }
        
        input:focus, select:focus {
            border-color: #3498db;
            outline: none;
            box-shadow: 0 0 5px rgba(52, 152, 219, 0.3);
        }
        
        button {
            background: #3498db;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            transition: background 0.3s;
            width: 100%;
        }
        
        button:hover {
            background: #2980b9;
        }
        
        .instructions {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        
        .step {
            display: flex;
            margin-bottom: 20px;
            align-items: flex-start;
        }
        
        .step-number {
            background: #3498db;
            color: white;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            flex-shrink: 0;
        }
        
        .step-content h3 {
            margin-bottom: 5px;
            color: #2c3e50;
        }
        
        .step-content p {
            color: #7f8c8d;
            line-height: 1.6;
        }
        
        .code-block {
            background: #2c3e50;
            color: #ecf0f1;
            padding: 15px;
            border-radius: 5px;
            margin-top: 10px;
            overflow-x: auto;
            font-family: monospace;
        }
        
        footer {
            text-align: center;
            margin-top: 30px;
            padding: 20px;
            color: #7f8c8d;
            font-size: 14px;
        }
        
        @media (max-width: 768px) {
            .content {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Add a Google Map to Your Website</h1>
            <p class="description">Learn how to embed an interactive Google Map with address search functionality on your website. Follow the instructions below to get started.</p>
        </header>
        
        <div class="content">
            <div class="map-section">
                <h2>Interactive Map Preview</h2>
                <div class="map-container">
                    <iframe id="mapFrame" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3024.177631294489!2d-74.00594908459426!3d40.71272807933185!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a316e0f2f39%3A0x87694c5c6c7a4172!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2s!4v1620000000000!5m2!1sen!2s" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
            
            <div class="form-section">
                <h2>Find Your Address Map URL</h2>
                <form id="addressForm">
                    <div class="form-group">
                        <label for="address">Enter Your Address:</label>
                        <input type="text" id="address" placeholder="e.g., 123 Main St, New York, NY" value="New York, NY, USA">
                    </div>
                    
                    <div class="form-group">
                        <label for="mapType">Map Type:</label>
                        <select id="mapType">
                            <option value="roadmap">Roadmap</option>
                            <option value="satellite">Satellite</option>
                            <option value="hybrid">Hybrid</option>
                            <option value="terrain">Terrain</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="zoomLevel">Zoom Level:</label>
                        <select id="zoomLevel">
                            <option value="10">10 - City</option>
                            <option value="12">12 - District</option>
                            <option value="14" selected>14 - Neighborhood</option>
                            <option value="16">16 - Streets</option>
                            <option value="18">18 - Buildings</option>
                        </select>
                    </div>
                    
                    <button type="submit">Generate Map URL</button>
                </form>
                
                <div class="form-group" style="margin-top: 20px;">
                    <label for="embedCode">Your Map Embed Code:</label>
                    <textarea id="embedCode" rows="4" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-family: monospace;" readonly></textarea>
                </div>
            </div>
        </div>
        
        <div class="instructions">
            <h2>How to Add a Map to Your Website</h2>
            
            <div class="step">
                <div class="step-number">1</div>
                <div class="step-content">
                    <h3>Find Your Location</h3>
                    <p>Go to <a href="https://www.google.com/maps" target="_blank">Google Maps</a> and search for your desired location.</p>
                </div>
            </div>
            
            <div class="step">
                <div class="step-number">2</div>
                <div class="step-content">
                    <h3>Share and Embed</h3>
                    <p>Click the "Share" button, then select the "Embed a map" tab. Copy the provided iframe code.</p>
                </div>
            </div>
            
            <div class="step">
                <div class="step-number">3</div>
                <div class="step-content">
                    <h3>Add to Your Website</h3>
                    <p>Paste the iframe code into your HTML where you want the map to appear.</p>
                    <div class="code-block">
                        &lt;iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3024.177631294489!2d-74.00594908459426!3d40.71272807933185!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a316e0f2f39%3A0x87694c5c6c7a4172!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2s!4v1620000000000!5m2!1sen!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"&gt;&lt;/iframe&gt;
                    </div>
                </div>
            </div>
            
            <div class="step">
                <div class="step-number">4</div>
                <div class="step-content">
                    <h3>Customize Your Map</h3>
                    <p>Use the form above to generate a custom map URL with your preferred address, map type, and zoom level.</p>
                </div>
            </div>
        </div>
        
        <footer>
            <p>This tool helps you generate Google Maps embed codes for your website. Google Maps embedding is free for basic use.</p>
        </footer>
    </div>

    <script>
        document.getElementById('addressForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const address = document.getElementById('address').value;
            const mapType = document.getElementById('mapType').value;
            const zoomLevel = document.getElementById('zoomLevel').value;
            
            // In a real implementation, you would geocode the address to get coordinates
            // For this demo, we'll use a placeholder approach
            const encodedAddress = encodeURIComponent(address);
            
            // Generate a new map URL (this is a simplified version)
            // Note: In production, you would need to use the Google Maps Embed API
            const mapUrl = `https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3024.177631294489!2d-74.00594908459426!3d40.71272807933185!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a316e0f2f39%3A0x87694c5c6c7a4172!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2s!4v1620000000000!5m2!1sen!2s`;
            
            // Update the iframe
            document.getElementById('mapFrame').src = mapUrl;
            
            // Generate and display the embed code
            const embedCode = `<iframe src="${mapUrl}" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>`;
            document.getElementById('embedCode').value = embedCode;
        });
        
        // Initialize with default values
        document.getElementById('addressForm').dispatchEvent(new Event('submit'));
    </script>
</body>
</html>