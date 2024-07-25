import numpy as np
import pandas as pd
import pymysql
import argparse
import sys

def process_core(file_path):
    # Load the Excel file
    df = pd.read_excel(file_path, engine='xlrd', skiprows=1)
    
    # Process data
    grouped_df = df['Ruas'].value_counts().reset_index()
    grouped_df.columns = ['Ruas', 'Jumlah']

    core = df.groupby('Ruas').agg({
        'Idle Baik': 'sum',
        'Idle Rusak': 'sum',
        'Core Operasi': 'sum'
    })

    core = core.astype(int)

    pivot_table = df.pivot_table(
        index='Ruas',
        aggfunc={'Idle Baik': 'sum',
                 'Idle Rusak': 'sum',
                 'Core Operasi': 'sum',
                 'Ruas': 'count'
                 },
    )

    pivot_table = pivot_table.astype(int)
    pivot_table = pivot_table.rename(columns={'Ruas': 'Jumlah Kabel'})
    pivot_table['Total'] = pivot_table[['Idle Baik', 'Idle Rusak', 'Core Operasi']].sum(axis=1)

    # Database connection parameters
    db_host = 'localhost'
    db_user = 'root'
    db_password = ''
    db_name = 'arnet'

    # Connect to the database and insert data
    connection = pymysql.connect(
        host=db_host,
        user=db_user,
        password=db_password,
        database=db_name
    )

    try:
        cursor = connection.cursor()
        cursor.execute("TRUNCATE TABLE cores")

        for index, row in pivot_table.iterrows():
            sql = """INSERT INTO cores (segment, good, bad, used, ccount, total)
                     VALUES (%s, %s, %s, %s, %s, %s)"""
            cursor.execute(sql, (index, row['Idle Baik'], row['Idle Rusak'],
                       row['Core Operasi'], row['Jumlah Kabel'], row['Total']))

        connection.commit()

    finally:
        cursor.close()
        connection.close()

    print("Data inserted successfully")

def main():
    parser = argparse.ArgumentParser(description='Process an Excel file and insert data into a database.')
    parser.add_argument('file_path', type=str, help='Path to the Excel file to process')

    args = parser.parse_args()

    if not args.file_path:
        print("Error: File path is required.")
        sys.exit(1)

    process_core(args.file_path)

if __name__ == '__main__':
    main()
