CREATE TABLE orders (
    id SERIAL PRIMARY KEY,
    order_number VARCHAR(50) NOT NULL,
    weight DECIMAL(10, 2) NOT NULL,
    city VARCHAR(100) NOT NULL,
    delivery_type VARCHAR(20) NOT NULL,
    branch_locker VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);