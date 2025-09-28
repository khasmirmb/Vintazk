Introduction 

The Vintazk KPI Dashboard is a performance monitoring tool designed to track and visualize Key Performance Indicators (KPIs) for both agents and teams. It consolidates monthly performance data from spreadsheets into an interactive dashboard that provides quick insights for managers and agents. 

Main Features 

a) Overview Page 

Displays the Agent Overall Rating (average rating across all agents). 

Displays the Team Overall Rating (average rating across all teams). 

Provides quick comparison charts for performance trends. 

b) Agents Page 

Shows the total number of agents. 

Name 

Position/Team 

Average Performance Score 

c) Teams Page 

Shows the total number of teams. 

Name 

Role/Department 

Average Performance Score 

Data Source 

The dashboard reads data from the Vintazk Sitewide KPI 2025 Excel file. 

Each sheet (e.g., January 2025, February 2025) contains: 

Agent Performance Data: productivity, QA, attendance, KPI rating, violations, quizzes, overall rating. 

Team Performance Data: attendance, team KPI, attrition, violations, overall rating. 

Technology 

Framework: Laravel (PHP)

Data Input: Excel spreadsheet (Vintazk Sitewide KPI 2025.xlsx) 

Visualization: Interactive charts and tables integrated into the Laravel frontend 


To run project:

PS: You need node

1. Clone project
2. Go to the folder application using cd command on your cmd or terminal
3. Run composer install on your cmd or terminal
4. Copy .env.example file to .env on the root folder. You can type copy .env.example .env if using command prompt Windows or cp .env.example .env if using terminal, Ubuntu
5. Open your .env file and change the database name (DB_DATABASE) to whatever you have, username (DB_USERNAME) and password (DB_PASSWORD) field correspond to your configuration.
6. Run php artisan key:generate
7. Run php artisan migrate
8. Run php artisan serve
9. Run npm run dev
10. Run php artisan db:seed --class=KpiSeeder (Data source)
