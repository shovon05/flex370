# SeismoSafe

**Earthquake Vulnerable Building Detection & Area-Based Risk Analysis System for Bangladesh**

SeismoSafe is a database-driven platform for detecting earthquake-vulnerable buildings and analyzing structural risk across different areas of Bangladesh.  
It collects building data, inspection records, seismic zone information, and structural history to generate risk scores and support safety planning, disaster preparedness, and monitoring.

---

## Project Overview

SeismoSafe helps users, inspectors, engineers, and administrators manage building-related information in one unified system.  
The platform evaluates building safety using structural details, inspection reports, seismic zone data, and code-compliance indicators.

The system is designed to:
- identify vulnerable buildings,
- classify risk levels,
- support area-based risk analysis,
- track inspection history,
- and improve emergency preparedness.

---

## Key Features

### Role-Based Login System
Separate dashboards are available for:
- Admin
- Structural Engineers
- Building Inspectors
- Citizens / Residents
- Building Owners
- Emergency Responders

Each role has controlled access to relevant data and functions.

### Building Registration
Owners can register building details in the system and create a unique record for each property.

### Complaint Management
Residents and owners can file complaints about building issues, including:
- photo uploads
- written descriptions
- issue tracking

### Building Information Display
Users can view complete building information, including:
- specifications
- ownership details
- inspection history
- structural condition

### Structural Weakness Scoring
The system calculates a building risk score based on:
- construction year
- number of floors
- building materials
- soil type
- BNBC compliance
- seismic zone distance

### Seismic Zone Classification
Bangladesh seismic zone data is stored in the database and used to apply risk multipliers based on location.

### Risk Heatmap and Area Filtering
Users can analyze vulnerable buildings through a heatmap and filter results by:
- city
- area
- ward
- risk score range

### BNBC Comparison
Older buildings are compared with major Bangladesh National Building Code updates to estimate vulnerability.

### Inspection History and Structural Image Upload
Inspectors can upload:
- crack detection reports
- column damage data
- foundation issue reports
- structural images

Each building supports multiple inspection records over time.

### Illegal Floor and Structural Modification Detection
The system compares approved building plans with the actual structure.  
Unauthorized modifications increase the risk score.

### Priority Ranking and Emergency Preparedness
High-risk buildings are ranked for urgent inspection.  
The system can also evaluate emergency readiness based on:
- fire exits
- emergency staircases
- open assembly areas

### AI Chatbot
An integrated chatbot provides:
- instant support
- frequently asked answers
- user guidance

### Admin Control Panel
Administrators can:
- manage users
- approve records
- monitor system activity
- moderate content

---

## Database Entities

- Users
- Owners
- Inspectors
- Residents
- Buildings
- Seismic Zones
- Risk Scores
- Inspection Reports
- Structural Images
- Emergency Facilities
- Building Plans
- Unauthorized Modifications
- Complaints

---

## Planned Repository Structure

```bash
SeismoSafe
│
├── README.md
├── docs
│   ├── ER_Diagram.png
│   ├── Database_Schema.png
│
├── database
│   ├── schema.sql
│   ├── seed_data.sql
│
├── src
│   └── application_code
