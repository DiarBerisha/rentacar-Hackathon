
CREATE TABLE IF NOT EXISTS cars (
    id INT AUTO_INCREMENT PRIMARY KEY,
    image_url VARCHAR(255) NOT NULL,
    brand VARCHAR(50) NOT NULL,
    model VARCHAR(50) NOT NULL,
    year INT NOT NULL,
    fuel_type VARCHAR(20) NOT NULL,
    transmission VARCHAR(20) NOT NULL,
    seats INT NOT NULL,
    doors INT NOT NULL,
    luggage INT NOT NULL,
    air_conditioning BOOLEAN NOT NULL DEFAULT 1,
    price_per_day DECIMAL(10,2) NOT NULL,
    description TEXT
);


INSERT INTO cars (image_url, brand, model, year, fuel_type, transmission, seats, doors, luggage, air_conditioning, price_per_day, description) VALUES
('https://cdn.motor1.com/images/mgl/QMoo3/s3/2022-mercedes-benz-eqs.jpg', 'Mercedes', 'EQS', 2023, 'Electric', 'Automatic', 5, 4, 3, 1, 120.00, 'Luxury electric sedan with premium features.'),
('https://www.topgear.com/sites/default/files/2022/03/1_3.jpg', 'BMW', 'X5', 2022, 'Diesel', 'Automatic', 5, 5, 5, 1, 90.00, 'Powerful SUV with great performance and comfort.'),
('https://cdn.jdpower.com/JDPA_2023%20Toyota%20Corolla%20Hybrid%20Silver%20Front%20Quarter%20View.jpg', 'Toyota', 'Corolla', 2023, 'Hybrid', 'Manual', 5, 4, 3, 1, 40.00, 'Fuel-efficient and reliable for daily driving.');
