# SeismoSafe
### Earthquake Vulnerable Building Detection & Area-Based Risk Analysis System for Bangladesh

## Project Overview

SeismoSafe is a database-driven system designed to detect earthquake-vulnerable buildings and perform **area-based structural risk analysis across Bangladesh**.

The platform collects building information, structural inspection records, and geographic data to evaluate the **earthquake vulnerability of buildings and surrounding areas**. Using a structured risk scoring algorithm, the system categorizes buildings based on their structural safety and helps authorities identify high-risk areas.

The system aims to support **urban safety planning, disaster preparedness, and structural monitoring** by combining seismic data, building information, and inspection reports into a unified database platform.

---

# Key Features

### Multi-Level Role-Based Login System
The platform supports separate dashboards for:
- Admin
- Structural Engineers
- Building Inspectors
- Citizens
- Emergency Responders

Each role has controlled access to building data, inspection reports, and risk analysis information.

---

### Structural Weakness Scoring Algorithm
The system calculates a **Building Risk Score** based on:

- Construction year  
- Number of floors  
- Building materials  
- Soil type  
- BNBC compliance  
- Distance from seismic zones  

Buildings are categorized as:

- Safe  
- Moderate Risk  
- High Risk  

---

### Seismic Zone Classification Integration
The database stores **Bangladesh earthquake zone classifications** and automatically applies risk multipliers depending on the zone where a building is located.

---

### Risk Heatmap & Area Filtering
The platform visualizes vulnerable buildings through a **risk heatmap**.

Users can filter data based on:

- City
- Area
- Ward
- Risk score range

---

### Old vs Updated Building Code Comparison
The system compares a building’s construction year with **major Bangladesh National Building Code (BNBC) updates**. Older buildings receive higher vulnerability scores.

---

### Inspection History & Structural Image Upload
Inspectors can upload structural inspection data including:

- Crack detection
- Column damage
- Foundation issues
- Structural images

Each building maintains **multiple inspection records over time**.

---

### Illegal Floor & Structural Modification Detection
The system compares **approved building plan data** with the actual building structure.

Unauthorized floor additions or structural modifications automatically increase the building risk score.

---

### Smart Priority Ranking & Emergency Preparedness Score
The platform automatically ranks **high-risk buildings** that require urgent inspection.

It also evaluates emergency readiness based on:

- Fire exits
- Emergency staircases
- Open assembly areas

The system can also estimate **how safe an area is for residential living** based on surrounding building risk levels.

---

# Potential Database Entities

- Buildings  
- Building Owners  
- Structural Engineers  
- Inspectors  
- Seismic Zones  
- Inspection Reports  
- Structural Images  
- Risk Scores  
- Emergency Facilities  
- Building Plans  
- Unauthorized Modifications  

---

# Planned Repository Structure

```
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
```

---

# Repository Status

This project repository is currently **under development**.

Upcoming updates will include:

- Feature documentation  
- ER/EER diagrams  
- Database schema design  
- SQL implementation  
- System architecture
