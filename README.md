## Prerequisites

- Ensure you have [Docker](https://www.docker.com/get-started) installed on your machine.

## Setup Instructions

### 1. Navigate to the Project Directory

Open your terminal and run:

```bash
git clone https://github.com/yagizatasoy/todo.git
cd todo
```

## Installation

To run containers:
```bash
make up
```

To access:
```bash
http://localhost:8080/
```

To run setup migrate:
```bash
make setup-migrate
```

To run database migration:
```bash
make migrate
```

To insert mock data:
```bash
make fixture
```

To Fetch tasks via Command:
```bash
make fetch-tasks
```

To access table:
```bash
http://localhost:8080/tasks
```

Optional Run Test:
```bash
make test
```

