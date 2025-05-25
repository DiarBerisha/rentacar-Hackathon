<?php include_once "config.php";
include_once "header.php"; ?>


<style>
    .car-cards-container {
        display: flex;
        flex-wrap: wrap;
        gap: 30px;
        justify-content: center;
        padding: 40px;
        background: #f5f5f5;
    }

    .car-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        max-width: 300px;
        text-align: center;
        padding: 20px;
        transition: transform 0.3s ease;
    }

    .car-card:hover {
        transform: translateY(-10px);
    }

    .car-card img {
        width: 100%;
        height: 180px;
        object-fit: cover;
        border-radius: 10px;
    }

    .car-card h3 {
        font-size: 20px;
        margin: 15px 0 10px;
        color: #333;
    }

    .car-card p {
        font-size: 14px;
        color: #666;
    }

    .car-card ul {
        list-style: none;
        padding: 0;
        margin: 10px 0;
        font-size: 14px;
        color: #444;
        text-align: left;
    }

    .car-card ul li {
        margin-bottom: 5px;
    }

    .price {
        font-size: 18px;
        font-weight: bold;
        color: #f7941d;
        display: block;
        margin-top: 10px;
    }

    .car-card button {
        background-color: #f7941d;
        color: white;
        border: none;
        padding: 10px 20px;
        font-size: 15px;
        border-radius: 8px;
        cursor: pointer;
        margin-top: 15px;
        transition: background 0.3s ease;
    }

    .car-card button:hover {
        background-color: #e88312;
    }
</style>

<div class="car-cards-container">

    <!-- 1. Mercedes EQS -->
    <div class="car-card">
        <img src="https://cdn.motor1.com/images/mgl/QMoo3/s3/2022-mercedes-benz-eqs.jpg" alt="Mercedes EQS">
        <h3>Mercedes EQS</h3>
        <p><strong>Year:</strong> 2023</p>
        <p>Luxury electric sedan with top-notch comfort and tech.</p>
        <ul>
            <li><strong>Seats:</strong> 5</li>
            <li><strong>Transmission:</strong> Automatic</li>
            <li><strong>Fuel:</strong> Electric</li>
        </ul>
        <span class="price">€120/day</span>
        <button>Rent Now</button>
    </div>

    <!-- 2. BMW X5 -->
    <div class="car-card">
        <img src="https://www.topgear.com/sites/default/files/2022/03/1_3.jpg" alt="BMW X5">
        <h3>BMW X5</h3>
        <p><strong>Year:</strong> 2022</p>
        <p>Powerful SUV with all-wheel drive and great cargo space.</p>
        <ul>
            <li><strong>Seats:</strong> 5</li>
            <li><strong>Transmission:</strong> Automatic</li>
            <li><strong>Fuel:</strong> Diesel</li>
        </ul>
        <span class="price">€90/day</span>
        <button>Rent Now</button>
    </div>

    <!-- 3. Toyota Corolla -->
    <div class="car-card">
        <img src="https://cdn.jdpower.com/JDPA_2023%20Toyota%20Corolla%20Hybrid%20Silver%20Front%20Quarter%20View.jpg" alt="Toyota Corolla">
        <h3>Toyota Corolla</h3>
        <p><strong>Year:</strong> 2023</p>
        <p>Reliable, fuel-efficient, and perfect for city driving.</p>
        <ul>
            <li><strong>Seats:</strong> 5</li>
            <li><strong>Transmission:</strong> Manual</li>
            <li><strong>Fuel:</strong> Petrol</li>
        </ul>
        <span class="price">€40/day</span>
        <button>Rent Now</button>
    </div>

    <!-- 4. Audi A6 -->
    <div class="car-card">
        <img src="https://cdn.motor1.com/images/mgl/0xOeO/s3/audi-a6-e-tron.jpg" alt="Audi A6">
        <h3>Audi A6</h3>
        <p><strong>Year:</strong> 2023</p>
        <p>Executive sedan with excellent ride quality and tech.</p>
        <ul>
            <li><strong>Seats:</strong> 5</li>
            <li><strong>Transmission:</strong> Automatic</li>
            <li><strong>Fuel:</strong> Hybrid</li>
        </ul>
        <span class="price">€85/day</span>
        <button>Rent Now</button>
    </div>

    <!-- 5. Volkswagen Golf -->
    <div class="car-card">
        <img src="https://cdn.motor1.com/images/mgl/0AN6G/s3/2020-vw-golf-gti.jpg" alt="Volkswagen Golf">
        <h3>Volkswagen Golf</h3>
        <p><strong>Year:</strong> 2021</p>
        <p>Compact hatchback with efficient performance and comfort.</p>
        <ul>
            <li><strong>Seats:</strong> 5</li>
            <li><strong>Transmission:</strong> Manual</li>
            <li><strong>Fuel:</strong> Petrol</li>
        </ul>
        <span class="price">€45/day</span>
        <button>Rent Now</button>
    </div>

    <!-- 6. Tesla Model 3 -->
    <div class="car-card">
        <img src="https://cdn.motor1.com/images/mgl/0ANMj/s3/2023-tesla-model-3.jpg" alt="Tesla Model 3">
        <h3>Tesla Model 3</h3>
        <p><strong>Year:</strong> 2023</p>
        <p>Modern electric sedan with autopilot and long range.</p>
        <ul>
            <li><strong>Seats:</strong> 5</li>
            <li><strong>Transmission:</strong> Automatic</li>
            <li><strong>Fuel:</strong> Electric</li>
        </ul>
        <span class="price">€100/day</span>
        <button>Rent Now</button>
    </div>

    <!-- 7. Ford Mustang -->
    <div class="car-card">
        <img src="https://cdn.motor1.com/images/mgl/6BB8N/s3/2024-ford-mustang-gt.jpg" alt="Ford Mustang">
        <h3>Ford Mustang</h3>
        <p><strong>Year:</strong> 2024</p>
        <p>Muscle car with powerful performance and iconic design.</p>
        <ul>
            <li><strong>Seats:</strong> 4</li>
            <li><strong>Transmission:</strong> Manual</li>
            <li><strong>Fuel:</strong> Petrol</li>
        </ul>
        <span class="price">€110/day</span>
        <button>Rent Now</button>
    </div>

    <!-- 8. Kia Sportage -->
    <div class="car-card">
        <img src="https://cdn.motor1.com/images/mgl/8MMoo/s3/2023-kia-sportage.jpg" alt="Kia Sportage">
        <h3>Kia Sportage</h3>
        <p><strong>Year:</strong> 2023</p>
        <p>Spacious SUV with great features and fuel economy.</p>
        <ul>
            <li><strong>Seats:</strong> 5</li>
            <li><strong>Transmission:</strong> Automatic</li>
            <li><strong>Fuel:</strong> Petrol</li>
        </ul>
        <span class="price">€65/day</span>
        <button>Rent Now</button>
    </div>

    <!-- 9. Hyundai Ioniq 5 -->
    <div class="car-card">
        <img src="https://cdn.motor1.com/images/mgl/2bWMP/s3/2022-hyundai-ioniq-5.jpg" alt="Hyundai Ioniq 5">
        <h3>Hyundai Ioniq 5</h3>
        <p><strong>Year:</strong> 2022</p>
        <p>Futuristic electric crossover with spacious interior.</p>
        <ul>
            <li><strong>Seats:</strong> 5</li>
            <li><strong>Transmission:</strong> Automatic</li>
            <li><strong>Fuel:</strong> Electric</li>
        </ul>
        <span class="price">€95/day</span>
        <button>Rent Now</button>
    </div>



</div>


<?php include_once "footer.php"; ?>