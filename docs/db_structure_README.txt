Картинка структуры БД сделана в https://dbdiagram.io/d
Код заменить на код снизу
P.S. кнопку highlight нужно постоянно переключать, чтобы подсветка работала нормально


Table users {
  id int [primary key]
  name string
  balance int
  login string
  password string
}

// Incomes

Table income_categories {
  id int [primary key]
  category string
}

Table incomes {
  id int [primary key]

  amount int
  date date
  description string

  is_fixed boolean

  income_category_id string [ref: > income_categories.id]
  user_id int [ref: > users.id]
}

Table fixed_incomes {
  id int [primary key]
  income_amount int

  fixed_amount int
  fixed_period string
  fixed_timestamps string[]

  category_id string [ref: > income_categories.id]
  user_id int [ref: > users.id]
}

// Expenses

Table expense_categories {
  id int [primary key]
  category string
}

Table expenses {
  id int [primary key]

  amount int
  date date
  description string

  is_fixed boolean

  expense_category_id string [ref: > expense_categories.id]
  user_id int [ref: > users.id]
}

Table fixed_expenses {
  id int [primary key]
  expense_amount int

  fixed_amount int
  fixed_period string
  fixed_timestamps string[]

  category_id string [ref: > expense_categories.id]
  user_id int [ref: > users.id]
}
