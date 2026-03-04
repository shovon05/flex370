# flex370
# Proposed Project Ideas

---

# Idea 1 — MentorGraph  
### Academic Consultation & Mentorship Management System

## Overview
MentorGraph is a database-driven platform designed to simplify academic consultations between **students, student tutors (ST), and faculty members**.

The system allows students to discover mentors based on **topic expertise, availability, and previous consultation feedback**, and schedule consultation sessions through a structured booking interface.

By combining consultation scheduling, expertise mapping, and reputation tracking, MentorGraph helps students efficiently find the most suitable academic support.

---

## Key Features

**Smart Mentor Discovery**  
Students can search for tutors or faculty members based on specific subjects or topics.

**Availability-Based Consultation Booking**  
Students can view mentor availability and schedule consultation sessions without conflicts.

**Topic Expertise Mapping**  
Tutors and faculty members can define subjects and topics they specialize in.

**Reputation & Review System**  
Students can provide ratings and feedback after consultation sessions.

**Tutor / Faculty Availability Management**  
Mentors can manage their consultation schedules and available time slots.

**Consultation History Tracking**  
Students can review past consultation sessions and feedback.

**Student Performance Feedback**  
Tutors or faculty members may optionally provide feedback about student understanding.

---

## Possible Database Entities

- Students  
- Student Tutors  
- Faculty Members  
- Subjects  
- Topics  
- Consultation Sessions  
- Availability Slots  
- Reviews  
- Ratings  
- Notifications  
- Student Evaluations  

---

# Idea 2 — ReCycleHub  
### Waste Recycling & Reuse Management Platform

## Overview
ReCycleHub is a database-driven platform designed to manage the collection, recycling, and reuse of **electrical and plastic waste**.

The system allows users to request waste pickup, track recycling processes, and earn rewards for contributing recyclable materials. The platform also supports selling **refurbished electronic products and recycled plastic products**, encouraging sustainable resource usage.

---

## Key Features

**Waste Pickup Request System**  
Users can submit waste pickup requests with waste details and images.

**Administrative Approval Workflow**  
Administrators review and approve recycling requests.

**Worker Assignment & Pickup Scheduling**  
Workers are assigned to approved requests and given pickup schedules.

**Recycling Request Tracking**  
Users can track the progress of their recycling requests.

**Reward Points System**  
Users earn reward points when selling recyclable waste.

**Reuse Product Marketplace**  
The platform supports selling refurbished electronic products and recycled plastic products.

---

## Possible Database Entities

- Users  
- Administrators  
- Workers  
- Waste Requests  
- Pickup Locations  
- Waste Items  
- Recycled Products  
- Orders  
- Reward Points  
- Support Messages  

---

# Idea 3 — SeismoSafe  
### Earthquake Vulnerable Building Detection & Area-Based Risk Analysis System for Bangladesh

## Overview
SeismoSafe is a database-driven system designed to detect earthquake-vulnerable buildings and perform **area-based structural risk analysis across Bangladesh**.

The platform collects building information, structural inspection reports, and geographic data to evaluate the **earthquake vulnerability of buildings and surrounding areas**. Using a risk scoring algorithm, the system categorizes buildings based on structural safety levels and helps authorities prioritize safety inspections and emergency preparedness planning.

---

## Key Features

**Multi-Level Role-Based Login System**  
Separate dashboards for Admin, Structural Engineers, Inspectors, Citizens, and Emergency Responders with role-based access control.

**Structural Weakness Scoring Algorithm**  
The system calculates a **Building Risk Score** based on construction year, number of floors, building materials, soil type, BNBC compliance, and distance from seismic zones. Buildings are categorized as Safe, Moderate Risk, or High Risk.

**Seismic Zone Classification Integration**  
The database stores Bangladesh’s earthquake zone classifications and applies risk multipliers based on each building’s location.

**Risk Heatmap & Area Filtering**  
An interactive map displays weak buildings using color-coded indicators. Users can filter results by city, area, ward, or risk score range.

**Old vs Updated Building Code Comparison**  
Buildings constructed before major BNBC updates receive higher vulnerability weighting.

**Inspection History & Structural Image Upload**  
Inspectors can upload structural inspection images such as cracks, column damage, or foundation issues. Multiple inspection records can be stored per building.

**Illegal Floor & Structural Modification Detection**  
The system compares approved building plans with actual floor counts. Unauthorized extensions automatically increase the building risk score.

**Smart Priority Ranking & Emergency Preparedness Score**  
The system ranks the most dangerous buildings based on calculated risk scores and evaluates emergency readiness based on fire exits, emergency stairs, and open assembly areas. It also indicates how suitable an area is for safe living.

---

## Possible Database Entities

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

# Repository Status

This repository is currently **under development**.  
Project documentation, ER/EER diagrams, database schema designs, and implementation files will be added progressively as the project progresses.
