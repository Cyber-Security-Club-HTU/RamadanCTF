FROM python:3.11-slim

# Install socat
RUN apt-get update && \
    apt-get install -y socat && \
    rm -rf /var/lib/apt/lists/*

# Set the working directory to /app
WORKDIR /app

# Copy your CTF challenge script into the container
COPY *.py /app/

# Expose the port that your CTF challenge will run on
EXPOSE 4444

# Set the entry point to your startup script
CMD socat TCP-LISTEN:4444,reuseaddr,fork EXEC:"python3 main.py",pty,nofork

