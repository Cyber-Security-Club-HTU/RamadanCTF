# Use an official Python runtime as the base image
FROM python:3.9-slim

# Set the working directory in the container to /app
WORKDIR /app

# Install Flask and Gunicorn
RUN pip install Flask gunicorn

# Copy the current directory contents into the container at /app
COPY . .

# Make port 5000 available to the world outside this container
EXPOSE 5000

# Use gunicorn to run the application
# Adjust the number of worker processes as needed
CMD ["gunicorn", "-w", "4", "-b", "0.0.0.0:5000", "main:app"]


# # Use an official Python runtime as the base image
# FROM python:3.9-slim

# # Set the working directory in the container to /app
# WORKDIR /app

# # Copy the current directory contents into the container at /app
# COPY . /app

# # Install Flask
# RUN pip install Flask

# # Make port 5000 available to the world outside this container
# EXPOSE 5000

# # Run app.py when the container launches
# CMD ["python", "main.py"]
