#!/usr/bin/env python
# coding: utf-8

# # Import Library #
# - pip install numpy
# - pip install matplotlib
# - pip install pandas

# In[1]:


import numpy as np
import pandas as pd
import xlrd
import pymysql


# ### Read Data ###

# In[2]:


df = pd.read_excel(
    '../storage/app/public/core/Core.xls', engine='xlrd', skiprows=1)
df.head()


# ### Group Total Cable ###

# In[3]:


grouped_df = df['Ruas'].value_counts().reset_index()
grouped_df.columns = ['Ruas', 'Jumlah']
# print(grouped_df)


# ## Counting Core ##

# In[4]:


core = df.groupby('Ruas').agg({
    'Idle Baik': 'sum',
    'Idle Rusak': 'sum',
    'Core Operasi': 'sum'
})

core = core.astype(int)
# print (core)


# In[5]:


pivot_table = df.pivot_table(
    index='Ruas',                # Index to group by
    aggfunc={'Idle Baik': 'sum',  # Aggregation functions
             'Idle Rusak': 'sum',
             'Core Operasi': 'sum',
             'Ruas': 'count'
             },
)

# Convert columns to integers if necessary
pivot_table = pivot_table.astype(int)
pivot_table = pivot_table.rename(columns={'Ruas': 'Jumlah Kabel'})

pivot_table['Total'] = pivot_table[['Idle Baik',
                                    'Idle Rusak', 'Core Operasi']].sum(axis=1)


# Display the pivot table
# print(pivot_table)


# ## Importing To My SQL ##

# In[6]:


db_host = 'localhost'
db_user = 'root'
db_password = ''
db_name = 'arnet'

connection = pymysql.connect(
    host=db_host,
    user=db_user,
    password=db_password,
    database=db_name
)

try:
    # Create a cursor object
    cursor = connection.cursor()

    # Truncate table if data exists
    cursor.execute("TRUNCATE TABLE cores")

    # Iterate over the pivot_table DataFrame and insert each row
    for index, row in pivot_table.iterrows():
        sql = """INSERT INTO cores (segment, good, bad, used, ccount, total)
                 VALUES (%s, %s, %s, %s, %s, %s)"""
        cursor.execute(sql, (index, row['Idle Baik'], row['Idle Rusak'],
                       row['Core Operasi'], row['Jumlah Kabel'], row['Total']))

    # Commit the transaction
    connection.commit()

finally:
    # Close the cursor and the connection
    cursor.close()
    connection.close()

print("Data inserted successfully")
