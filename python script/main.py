from faker import Faker
import random

fake = Faker()

# Generate Cars
print("INSERT INTO Cars (Model, Year_, PlateID, Status_, BaseRate) VALUES")
for _ in range(100):
    model = fake.company()  # Using company name as a placeholder for car model
    year = random.randint(1990, 2022)
    plate_id = fake.license_plate()
    status = random.choice(['Available', 'Rented', 'Out of Service'])
    base_rate = round(random.uniform(30.0, 100.0), 2)
    print(f"('{model}', {year}, '{plate_id}', '{status}', {base_rate}),")

# Generate Customers
print("\nINSERT INTO Users (FirstName, LastName, Email, Username) VALUES")
for _ in range(100):
    first_name = fake.first_name()
    last_name = fake.last_name()
    email = fake.email()
    username = fake.user_name()
    print(f"('{first_name}', '{last_name}', '{email}', '{username}'),")

# Generate Locations
print("\nINSERT INTO Locations (LocationName, Country, City) VALUES")
for _ in range(100):
    location_name = fake.street_name() + " Office"
    country = fake.country()
    city = fake.city()
    print(f"('{location_name}', '{country}', '{city}'),")

# Assume Reservation IDs are incremental and start from 1
print("\nINSERT INTO Reservations (CarID, CustomerID, StartDate, EndDate, PickupLocationID, DropOffLocationID, Status_) VALUES")
for i in range(100):
    car_id = random.randint(1, 100)
    customer_id = random.randint(1, 100)
    start_date = fake.date_between(start_date='-1y', end_date='today')
    end_date = fake.date_between(start_date=start_date, end_date='+30d')
    pickup_location_id = random.randint(1, 100)
    dropoff_location_id = random.randint(1, 100)
    status = random.choice(['Reserved', 'Active', 'Completed'])
    print(f"({car_id}, {customer_id}, '{start_date}', '{end_date}', {pickup_location_id}, {dropoff_location_id}, '{status}'),")

# Assume Payment IDs are incremental and start from 1
print("\nINSERT INTO Payments (ReservationID, Amount, PaymentDate, PaymentMethod) VALUES")
for i in range(1, 101):
    amount = round(random.uniform(100.0, 500.0), 2)
    payment_date = fake.date_between(start_date='-1y', end_date='today')
    payment_method = random.choice(['Credit Card', 'Debit Card', 'PayPal', 'Cash'])
    print(f"({i}, {amount}, '{payment_date}', '{payment_method}'),")
